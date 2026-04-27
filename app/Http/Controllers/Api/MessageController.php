<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\MessageReaction;
use App\Models\MessageRead;
use App\Models\MessageDeletion;
use App\Events\MessageSent;
use App\Events\TypingIndicator;
use App\Events\MessageDeleted;
use App\Events\MessageReacted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function index(Request $request, $id)
    {
        $messages = Message::where('conversation_id', $id)
            ->whereDoesntHave('deletions', function ($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            })
            ->with(['sender', 'reactions', 'replyTo'])
            ->latest()
            ->paginate(30);

        return response()->json($messages);
    }

    public function store(Request $request, $id)
    {
        $conversation = Conversation::findOrFail($id);
        
        $request->validate([
            'type' => 'required|in:text,image,video,audio,voice,document,location,contact',
            'content' => 'required_if:type,text|string|nullable',
            'file' => 'required_if:type,image,video,audio,voice,document|file|max:20480', // 20MB
            'latitude' => 'required_if:type,location|numeric',
            'longitude' => 'required_if:type,location|numeric',
            'reply_to_id' => 'sometimes|exists:messages,id',
        ]);

        $data = [
            'conversation_id' => $id,
            'sender_id' => $request->user()->id,
            'type' => $request->type,
            'content' => $request->content,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'reply_to_id' => $request->reply_to_id,
        ];

        if ($request->hasFile('file')) {
            $folder = 'uploads/' . str_plural($request->type);
            $path = $request->file('file')->store($folder, 'public');
            $data['file_path'] = $path;
            $data['file_name'] = $request->file('file')->getClientOriginalName();
            $data['file_size'] = $request->file('file')->getSize();
        }

        $message = Message::create($data);
        
        // Update conversation last_message_id
        $conversation->update(['last_message_id' => $message->id]);

        // Broadcast event
        broadcast(new MessageSent($message->load('sender')))->toOthers();

        return response()->json($message->load('sender'));
    }

    public function markRead(Request $request, $id)
    {
        $messages = Message::where('conversation_id', $id)
            ->where('sender_id', '!=', $request->user()->id)
            ->get();

        foreach ($messages as $message) {
            MessageRead::updateOrCreate(
                ['message_id' => $message->id, 'user_id' => $request->user()->id],
                ['read_at' => now()]
            );
        }

        // For 1-on-1 chats, update the main message table as well for easier state management
        Message::where('conversation_id', $id)
            ->where('sender_id', '!=', $request->user()->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['message' => 'Messages marked as read']);
    }

    public function typingIndicator(Request $request, $id)
    {
        broadcast(new TypingIndicator($id, $request->user()->id, $request->is_typing))->toOthers();
        return response()->json(['message' => 'Typing indicator sent']);
    }

    public function update(Request $request, $id)
    {
        $message = Message::where('id', $id)->where('sender_id', $request->user()->id)->firstOrFail();
        $request->validate(['content' => 'required|string']);
        $message->update(['content' => $request->content]);
        return response()->json($message);
    }

    public function destroyForEveryone(Request $request, $id)
    {
        $message = Message::where('id', $id)->where('sender_id', $request->user()->id)->firstOrFail();
        
        // delete file if exists
        if ($message->file_path) {
            Storage::disk('public')->delete($message->file_path);
        }

        $message->delete(); // soft delete

        broadcast(new MessageDeleted($id, $message->conversation_id))->toOthers();

        return response()->json(['message' => 'Deleted for everyone']);
    }

    public function destroyForMe(Request $request, $id)
    {
        MessageDeletion::firstOrCreate([
            'message_id' => $id,
            'user_id' => $request->user()->id
        ]);
        
        return response()->json(['message' => 'Deleted for me']);
    }

    public function react(Request $request, $id)
    {
        $request->validate(['emoji' => 'required|string']);
        
        $reaction = MessageReaction::updateOrCreate(
            ['message_id' => $id, 'user_id' => $request->user()->id],
            ['emoji' => $request->emoji]
        );

        broadcast(new MessageReacted($reaction))->toOthers();

        return response()->json($reaction);
    }

    public function removeReaction(Request $request, $id)
    {
        MessageReaction::where('message_id', $id)->where('user_id', $request->user()->id)->delete();
        return response()->json(['message' => 'Reaction removed']);
    }

    public function toggleStar(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_starred' => !$message->is_starred]);
        return response()->json(['is_starred' => $message->is_starred]);
    }

    public function search(Request $request)
    {
        $query = $request->query('q');
        $messages = Message::where('content', 'LIKE', "%{$query}%")
            ->whereHas('conversation.members', function($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            })
            ->with(['sender', 'conversation'])
            ->get();

        return response()->json($messages);
    }

    public function starred(Request $request)
    {
        $messages = Message::where('is_starred', true)
            ->whereHas('conversation.members', function($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            })
            ->with(['sender', 'conversation'])
            ->get();

        return response()->json($messages);
    }

    public function forward(Request $request, $id)
    {
        $request->validate([
            'conversation_ids' => 'required|array',
            'conversation_ids.*' => 'exists:conversations,id'
        ]);

        $original = Message::findOrFail($id);

        foreach ($request->conversation_ids as $convId) {
            $newMessage = $original->replicate();
            $newMessage->conversation_id = $convId;
            $newMessage->sender_id = $request->user()->id;
            $newMessage->read_at = null;
            $newMessage->is_starred = false;
            $newMessage->save();

            broadcast(new MessageSent($newMessage->load('sender')))->toOthers();
        }

        return response()->json(['message' => 'Forwarded successfully']);
    }
}

// helper
if (!function_exists('str_plural')) {
    function str_plural($value) {
        return \Illuminate\Support\Str::plural($value);
    }
}
