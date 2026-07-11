<?php

namespace App\Models;

use App\Observers\ContactMessageObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(ContactMessageObserver::class)]
class ContactMessage extends Model
{
    protected $fillable = ['name', 'email', 'message', 'read_at'];

    protected $casts = [
        'read_at' => 'datetime',
    ];
}
