<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'chat_messages';
    
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'file_path',
        'seen',
        'reply_to_id',
        'reply_to_content',
        'image_path',
        'image_name',
        'image_size',
        'mime_type',
        'audio_path',
        'audio_name',
        'audio_size',
        'audio_mime_type'
    ];

    protected $casts = [
        'seen' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // For backward compatibility
    public function user() {
        return $this->sender();
    }
}
