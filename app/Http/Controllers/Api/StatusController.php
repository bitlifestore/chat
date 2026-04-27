<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        $contactIds = Contact::where('user_id', $request->user()->id)->pluck('contact_id');
        $contactIds[] = $request->user()->id; // include self

        $statuses = Status::whereIn('user_id', $contactIds)
            ->where('expires_at', '>', now())
            ->with('user')
            ->latest()
            ->get();

        return response()->json($statuses);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:text,image,video',
            'content' => 'required_if:type,text|nullable|string',
            'file' => 'required_if:type,image,video|file|max:10240',
        ]);

        $data = [
            'user_id' => $request->user()->id,
            'type' => $request->type,
            'content' => $request->content,
            'caption' => $request->caption,
            'expires_at' => now()->addHours(24)
        ];

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads/statuses', 'public');
            $data['file_path'] = $path;
        }

        $status = Status::create($data);

        return response()->json($status->load('user'));
    }

    public function markViewed(Request $request, $id)
    {
        \App\Models\StatusView::firstOrCreate([
            'status_id' => $id,
            'user_id' => $request->user()->id
        ]);
        
        return response()->json(['message' => 'Status marked as viewed']);
    }

    public function destroy(Request $request, $id)
    {
        $status = Status::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        if ($status->file_path) {
            Storage::disk('public')->delete($status->file_path);
        }
        $status->delete();
        return response()->json(['message' => 'Status deleted']);
    }
}
