<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TypingIndicator implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $conversation_id;
    public $user_id;
    public $is_typing;

    public function __construct($conversation_id, $user_id, $is_typing)
    {
        $this->conversation_id = $conversation_id;
        $this->user_id = $user_id;
        $this->is_typing = $is_typing;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('conversation.' . $this->conversation_id),
        ];
    }

    public function broadcastAs()
    {
        return 'user.typing';
    }
}
