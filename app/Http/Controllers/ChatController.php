<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::where('id','!=',auth()->id())->get();
        return view('dashboard', compact('users'));
    }

    public function messages($id)
    {
        try {
            if(!auth()->check()){
                return response()->json([], 401);
            }

            // Get messages from database for this conversation
            $messages = Message::where(function($query) use ($id) {
                $query->where('sender_id', auth()->id())
                      ->where('receiver_id', $id);
            })->orWhere(function($query) use ($id) {
                $query->where('sender_id', $id)
                      ->where('receiver_id', auth()->id());
            })->orderBy('created_at', 'asc')->get();

            return response()->json($messages);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function send(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'message' => 'required|string|max:1000',
                'receiver_id' => 'required|exists:users,id',
                'reply_to_id' => 'nullable|integer',
                'reply_to_content' => 'nullable|string|max:1000'
            ]);

            // Create and save message to database
            $messageData = [
                'sender_id' => auth()->id(),
                'receiver_id' => $request->receiver_id,
                'content' => $request->message,
                'seen' => false
            ];

            // Add reply information if provided
            if ($request->reply_to_id && $request->reply_to_content) {
                $messageData['reply_to_id'] = $request->reply_to_id;
                $messageData['reply_to_content'] = $request->reply_to_content;
            }

            $message = Message::create($messageData);

            // Mark as seen if this is a reply to our own message
            $this->markMessagesAsSeen($request->receiver_id, auth()->id());

            return response()->json($message);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function sendImage(Request $req)
    {
        try {
            // Check if user is authenticated
            if (!auth()->check()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Validate request
            $validated = $req->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'receiver_id' => 'required|exists:users,id',
                'reply_to_id' => 'nullable|integer',
                'reply_to_content' => 'nullable|string|max:1000'
            ]);

            // Check if file exists
            if (!$req->hasFile('image') || !$req->file('image')->isValid()) {
                return response()->json(['error' => 'Invalid file upload'], 400);
            }

            // Store image
            $image = $req->file('image');
            
            // Create storage directory if it doesn't exist
            $storagePath = storage_path('app/public/chat/images');
            if (!is_dir($storagePath)) {
                mkdir($storagePath, 0755, true);
            }
            
            $path = $image->store('chat/images', 'public');
            
            if (!$path) {
                return response()->json(['error' => 'Failed to store image'], 500);
            }
            
            // Create and save image message to database
            $messageData = [
                'sender_id' => auth()->id(),
                'receiver_id' => $req->receiver_id,
                'image_path' => $path,
                'image_name' => $image->getClientOriginalName(),
                'image_size' => $image->getSize(),
                'mime_type' => $image->getMimeType(),
                'seen' => false
            ];

            // Add reply information if provided
            if (!empty($req->reply_to_id) && !empty($req->reply_to_content)) {
                $messageData['reply_to_id'] = $req->reply_to_id;
                $messageData['reply_to_content'] = $req->reply_to_content;
            }

            $message = Message::create($messageData);

            // Mark as seen if this is a reply to our own message
            $this->markMessagesAsSeen($req->receiver_id, auth()->id());

            return response()->json($message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Image upload error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteMessage($id)
    {
        try {
            if (!auth()->check()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $message = Message::find($id);
            
            if (!$message) {
                return response()->json(['error' => 'Message not found'], 404);
            }

            // Check if user owns the message (sender) or is the receiver
            if ($message->sender_id != auth()->id() && $message->receiver_id != auth()->id()) {
                return response()->json(['error' => 'Forbidden'], 403);
            }

            $message->delete();

            return response()->json(['success' => 'Message deleted successfully']);

        } catch (\Exception $e) {
            \Log::error('Delete message error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete message'], 500);
        }
    }

    public function clearChat($id)
    {
        try {
            if (!auth()->check()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Delete all messages between authenticated user and the specified user
            Message::where(function($query) use ($id) {
                $query->where('sender_id', auth()->id())
                      ->where('receiver_id', $id);
            })->orWhere(function($query) use ($id) {
                $query->where('sender_id', $id)
                      ->where('receiver_id', auth()->id());
            })->delete();

            return response()->json(['success' => 'Chat cleared successfully']);

        } catch (\Exception $e) {
            \Log::error('Clear chat error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to clear chat'], 500);
        }
    }

    public function sendAudio(Request $req)
    {
        try {
            // Check if user is authenticated
            if (!auth()->check()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Validate request
            $validated = $req->validate([
                'audio' => 'required|file|mimes:audio/mpeg,audio/wav,audio/mp3,audio/ogg|max:10240', // 10MB max
                'receiver_id' => 'required|exists:users,id',
                'reply_to_id' => 'nullable|integer',
                'reply_to_content' => 'nullable|string|max:1000'
            ]);

            // Store audio
            $audio = $req->file('audio');
            
            // Create storage directory if it doesn't exist
            $storagePath = storage_path('app/public/chat/audios');
            if (!is_dir($storagePath)) {
                mkdir($storagePath, 0755, true);
            }
            
            $path = $audio->store('chat/audios', 'public');
            
            if (!$path) {
                return response()->json(['error' => 'Failed to store audio'], 500);
            }
            
            // Create and save audio message to database
            $messageData = [
                'sender_id' => auth()->id(),
                'receiver_id' => $req->receiver_id,
                'audio_path' => $path,
                'audio_name' => $audio->getClientOriginalName(),
                'audio_size' => $audio->getSize(),
                'audio_mime_type' => $audio->getMimeType(),
                'seen' => false
            ];

            // Add reply information if provided
            if (!empty($req->reply_to_id) && !empty($req->reply_to_content)) {
                $messageData['reply_to_id'] = $req->reply_to_id;
                $messageData['reply_to_content'] = $req->reply_to_content;
            }

            $message = Message::create($messageData);

            // Mark as seen if this is a reply to our own message
            $this->markMessagesAsSeen($req->receiver_id, auth()->id());

            return response()->json($message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Audio upload error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to upload audio: ' . $e->getMessage()
            ], 500);
        }
    }

    private function markMessagesAsSeen($senderId, $receiverId)
    {
        // Mark messages as seen when user replies
        Message::where('sender_id', $senderId)
               ->where('receiver_id', $receiverId)
               ->where('seen', false)
               ->update(['seen' => true]);
    }
}
