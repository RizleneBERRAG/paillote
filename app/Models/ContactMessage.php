<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'contact_messages';

    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message',
        'consent', 'ip', 'user_agent', 'status',
    ];

    protected $casts = [
        'consent' => 'boolean',
    ];
}
