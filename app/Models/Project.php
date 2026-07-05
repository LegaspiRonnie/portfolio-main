<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'description', 'tags', 'sort_order', 'is_archived',
        'image_url', 'demo_url', 'repo_url', 'rating', 'featured',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_archived' => 'boolean',
        'featured' => 'boolean',
        'rating' => 'float',
    ];
}
