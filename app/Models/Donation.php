<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tx_ref', 'first_name', 'last_name', 'email', 'amount', 'purpose', 'status'
    ];
}
