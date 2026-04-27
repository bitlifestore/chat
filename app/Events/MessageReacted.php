<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageReacted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reaction;

    public function __construct($reaction)
    {
        $this->reaction = $reaction;
    }

    public function broadcastOn(): array
    {
        $message = \App\Models\Message::find($this->reaction->message_id);
        return [
            new PrivateChannel('conversation.' . $message->conversation_id),
        ];
    }

    public function broadcastAs()
    {
        return 'message.reacted';
    }
}
