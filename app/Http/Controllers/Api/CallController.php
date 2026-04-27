<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Events\IncomingCall;
use App\Events\CallAnswered;
use App\Events\CallDeclined;
use App\Events\CallEnded;
use App\Events\IceCandidate;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function history(Request $request)
    {
        $calls = Call::where('caller_id', $request->user()->id)
            ->orWhere('receiver_id', $request->user()->id)
            ->with(['caller', 'receiver'])
            ->latest()
            ->get();

        return response()->json($calls);
    }

    public function initiate(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'type' => 'required|in:voice,video',
            'sdp_offer' => 'required|string',
        ]);

        $call = Call::create([
            'caller_id' => $request->user()->id,
            'receiver_id' => $request->receiver_id,
            'type' => $request->type,
            'status' => 'ringing'
        ]);

        broadcast(new IncomingCall($call, $request->sdp_offer))->toOthers();

        return response()->json($call);
    }

    public function show($id)
    {
        return response()->json(Call::with(['caller', 'receiver'])->findOrFail($id));
    }

    public function answer(Request $request, $id)
    {
        $call = Call::findOrFail($id);
        $call->update(['status' => 'answered', 'started_at' => now()]);

        $request->validate(['sdp_answer' => 'required|string']);

        broadcast(new CallAnswered($call, $request->sdp_answer))->toOthers();

        return response()->json($call);
    }

    public function decline(Request $request, $id)
    {
        $call = Call::findOrFail($id);
        $call->update(['status' => 'declined']);

        broadcast(new CallDeclined($call))->toOthers();

        return response()->json(['message' => 'Call declined']);
    }

    public function end(Request $request, $id)
    {
        $call = Call::findOrFail($id);
        $endedAt = now();
        $duration = 0;
        if ($call->started_at) {
            $duration = $endedAt->diffInSeconds($call->started_at);
        }

        $call->update([
            'status' => 'ended',
            'ended_at' => $endedAt,
            'duration' => $duration
        ]);

        broadcast(new CallEnded($call))->toOthers();

        return response()->json($call);
    }

    public function sendIceCandidate(Request $request, $id)
    {
        $request->validate(['candidate' => 'required']);
        
        broadcast(new IceCandidate($id, $request->user()->id, $request->candidate))->toOthers();

        return response()->json(['message' => 'ICE candidate sent']);
    }
}
