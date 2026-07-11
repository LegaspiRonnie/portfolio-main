<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'ip_address', 'path', 'user_agent', 'referer', 'visitor_cookie', 'session_id',
        'country', 'city', 'isp',
    ];
}
