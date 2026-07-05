<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;

class GalleryController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $projects = Project::where('is_archived', false)->orderBy('sort_order')->get();
        $tags = $projects->flatMap(fn (Project $project) => $project->tags ?? [])->unique()->values();

        return view('gallery', compact('profile', 'projects', 'tags'));
    }
}
