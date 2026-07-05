<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class PricingController extends Controller
{
    public function index()
    {
        $profile = Profile::first();

        return view('pricing', compact('profile'));
    }
}
