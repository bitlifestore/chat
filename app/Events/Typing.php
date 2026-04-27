<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Typing implements ShouldBroadcast
{
    public $user_id;
    public $receiver_id;

    public function __construct($id)
    {
        $this->user_id = auth()->id();
        $this->receiver_id = $id;
    }

    public function broadcastOn()
    {
        return ['chat'];
    }
}
