<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Added user_id
        'full_name', 
        'email', 
        'company', 
        'subject', 
        'message', 
        'admin_reply', 
        'replied_at'
    ];
    
    protected $casts = [
        'replied_at' => 'datetime',
    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
