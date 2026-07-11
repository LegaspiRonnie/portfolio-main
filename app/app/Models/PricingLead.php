<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingLead extends Model
{
    protected $fillable = ['name', 'email', 'plan', 'message', 'read_at'];

    protected $casts = [
        'read_at' => 'datetime',
    ];
}
