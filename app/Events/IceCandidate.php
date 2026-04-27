<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IceCandidate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $user_id;
    public $candidate;

    public function __construct($id, $user_id, $candidate)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->candidate = $candidate;
    }

    public function broadcastOn(): array
    {
        // Broadcast to the other user in the call
        $call = \App\Models\Call::find($this->id);
        $targetId = $this->user_id == $call->caller_id ? $call->receiver_id : $call->caller_id;
        return [
            new PrivateChannel('user.' . $targetId),
        ];
    }

    public function broadcastAs()
    {
        return 'call.ice-candidate';
    }
}
