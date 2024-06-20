<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'sender',
        'chat_id',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean'
    ];
}
