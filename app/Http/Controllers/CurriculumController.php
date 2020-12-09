<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return inertia('Curriculum', [
            'user' => $user,
        ]);
    }
}
