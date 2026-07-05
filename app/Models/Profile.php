<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'hero_heading', 'hero_subheading',
        'about_paragraph_1', 'about_paragraph_2',
        'email', 'phone', 'location', 'website_url',
        'stats_months_internship', 'stats_technologies', 'stats_percent_learning',
        'latitude', 'longitude', 'github_username',
    ];
}
