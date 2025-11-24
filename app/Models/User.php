<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'phoneNo',
        'profile_p',
        'role',
        'member_status', 
        'status',
        'id_card',
        'passport',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // for chat
   public function conversations()
    {
        return $this->hasMany(Conversation::class, 'user1_id')->orWhere('user2_id', $this->id);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function deliveryBoy()
    {
        return $this->hasOne(DeliveryBoy::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}