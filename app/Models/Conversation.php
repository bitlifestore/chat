<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'avatar',
        'is_group',
        'description',
        'last_message_id'
    ];

    public function members()
    {
        return $this->belongsToMany(User::class, 'conversation_members')
            ->withPivot('is_admin', 'muted_until', 'is_archived', 'is_pinned')
            ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function lastMessage()
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }
}
