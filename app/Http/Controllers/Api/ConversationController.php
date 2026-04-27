<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    public function index(Request $request)
    {
        $conversations = $request->user()->conversations()
            ->with(['members', 'lastMessage'])
            ->latest('updated_at')
            ->get();

        return response()->json($conversations);
    }

    public function startPrivateChat(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $myId = $request->user()->id;
        $otherId = $request->user_id;

        // Check if private conversation already exists
        $conversation = Conversation::where('is_group', false)
            ->whereHas('members', function($q) use ($myId) {
                $q->where('user_id', $myId);
            })
            ->whereHas('members', function($q) use ($otherId) {
                $q->where('user_id', $otherId);
            })
            ->first();

        if (!$conversation) {
            $conversation = Conversation::create(['is_group' => false]);
            $conversation->members()->attach([$myId, $otherId]);
        }

        return response()->json($conversation->load('members'));
    }

    public function createGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'members' => 'required|array|min:1',
            'members.*' => 'exists:users,id',
        ]);

        $conversation = Conversation::create([
            'name' => $request->name,
            'is_group' => true,
            'description' => $request->description
        ]);

        $members = $request->members;
        $members[] = $request->user()->id; // Add self

        // Attach members and set creator as admin
        $conversation->members()->attach($members);
        $conversation->members()->updateExistingPivot($request->user()->id, ['is_admin' => true]);

        return response()->json($conversation->load('members'));
    }

    public function addMembers(Request $request, $id)
    {
        $conversation = Conversation::findOrFail($id);
        
        // Only admins can add members (simple check)
        if (!$conversation->members()->where('user_id', $request->user()->id)->wherePivot('is_admin', true)->exists()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'members' => 'required|array',
            'members.*' => 'exists:users,id',
        ]);

        $conversation->members()->syncWithoutDetaching($request->members);

        return response()->json($conversation->load('members'));
    }

    public function removeMember(Request $request, $id, $userId)
    {
        $conversation = Conversation::findOrFail($id);

        if (!$conversation->members()->where('user_id', $request->user()->id)->wherePivot('is_admin', true)->exists()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $conversation->members()->detach($userId);

        return response()->json(['message' => 'Member removed']);
    }

    public function updateSettings(Request $request, $id)
    {
        $conversation = Conversation::findOrFail($id);
        $pivot = $conversation->members()->where('user_id', $request->user()->id)->first()->pivot;

        $request->validate([
            'is_archived' => 'sometimes|boolean',
            'is_pinned' => 'sometimes|boolean',
            'muted_until' => 'sometimes|nullable|date',
        ]);

        $conversation->members()->updateExistingPivot($request->user()->id, $request->only('is_archived', 'is_pinned', 'muted_until'));

        return response()->json(['message' => 'Settings updated']);
    }

    public function leaveGroup(Request $request, $id)
    {
        $conversation = Conversation::findOrFail($id);
        $conversation->members()->detach($request->user()->id);

        return response()->json(['message' => 'Left group']);
    }
}
