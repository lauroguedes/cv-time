<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'college' => 'required',
            'start_date' => 'required',
            'course' => 'required',
        ])->validateWithBag('store');

        Education::create($request->all());

        return redirect()->route('curriculum');
    }

    public function update(Request $request, Education $education)
    {
        \Validator::make($request->all(), [
            'college' => 'required',
            'start_date' => 'required',
            'course' => 'required',
        ])->validateWithBag('store');

        $education->update($request->all());

        return redirect()->route('curriculum');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('curriculum');
    }
}
