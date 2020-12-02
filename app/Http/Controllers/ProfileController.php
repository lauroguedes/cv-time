<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = auth()->user()->profile;

        return \Inertia::render('Profile/Profile', [
            'profile' => $profile
        ]);
    }
}
