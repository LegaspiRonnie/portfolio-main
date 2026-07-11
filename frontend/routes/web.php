<?php

use App\Support\PortfolioSample;
use App\Support\StaticContent;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;

// Static frontend for now — all content comes from resources/content/content.json
// via StaticContent. Will be swapped for calls to the backend API (../app) later.

Route::get('/', function () {
    return view('home', [
        'profile' => StaticContent::profile(),
        'projects' => StaticContent::projects(),
        'experience' => StaticContent::experience(),
        'skills' => StaticContent::skills(),
        'stats' => StaticContent::stats(),
        'coordinates' => StaticContent::coordinates(),
        'weather' => null,
        'github' => null,
        'quotes' => StaticContent::quotes(),
        'posts' => StaticContent::posts()->take(3),
        'samples' => PortfolioSample::all(),
    ]);
})->name('home');

Route::get('/gallery', function () {
    $projects = StaticContent::projects();

    return view('gallery', [
        'profile' => StaticContent::profile(),
        'projects' => $projects,
        'tags' => $projects->flatMap(fn ($project) => $project->tags ?? [])->unique()->values(),
    ]);
})->name('gallery');

Route::get('/pricing', function () {
    return view('pricing', ['profile' => StaticContent::profile()]);
})->name('pricing');

Route::get('/blog', function () {
    $posts = StaticContent::posts();

    $paginated = new LengthAwarePaginator(
        $posts->forPage(request()->integer('page', 1), 6),
        $posts->count(),
        6,
        request()->integer('page', 1),
        ['path' => request()->url()],
    );

    return view('blog.index', [
        'profile' => StaticContent::profile(),
        'posts' => $paginated,
    ]);
})->name('blog.index');

Route::get('/blog/{slug}', function (string $slug) {
    $post = StaticContent::post($slug);

    abort_if($post === null, 404);

    return view('blog.show', [
        'profile' => StaticContent::profile(),
        'post' => $post,
        'related' => StaticContent::posts()->where('slug', '!=', $slug)->take(2)->values(),
    ]);
})->name('blog.show');
