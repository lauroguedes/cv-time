<?php

namespace App\Http\Controllers;

use App\Models\Profile;
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

    public function update(Request $request, Profile $profile)
    {
        \Validator::make($request->all(), [
            'city_uf' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'date_birth' => ['required'],
        ])->validateWithBag('updateUserDetails');

        $profile->update([
            'city_uf' => $request->city_uf,
            'phone' => $request->phone,
            'date_birth' => $request->date_birth,
            'hobbies' => $request->hobbies,
            'about_me' => $request->about_me,
        ]);

        return redirect()->back();
    }
}
