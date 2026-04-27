<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'contact_id',
        'nickname',
        'is_blocked',
        'is_favourite'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contactUser()
    {
        return $this->belongsTo(User::class, 'contact_id');
    }
}
