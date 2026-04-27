<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallEnded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $call;

    public function __construct($call)
    {
        $this->call = $call;
    }

    public function broadcastOn(): array
    {
        $id = auth()->id() == $this->call->caller_id ? $this->call->receiver_id : $this->call->caller_id;
        return [
            new PrivateChannel('user.' . $id),
        ];
    }

    public function broadcastAs()
    {
        return 'call.ended';
    }
}
