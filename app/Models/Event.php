<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // Added 'image' to the list
    protected $fillable = ['title', 'description', 'event_date', 'image'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}