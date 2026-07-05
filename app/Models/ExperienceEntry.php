<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienceEntry extends Model
{
    protected $fillable = ['type', 'title', 'organization', 'period_label', 'bullets', 'description', 'sort_order'];

    protected $casts = [
        'bullets' => 'array',
    ];
}
