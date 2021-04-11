<?php

namespace App\Http\Controllers;

use App\Models\EmploymentHistory;
use App\Models\User;
use Illuminate\Http\Request;
class EmploymentHistoryController extends Controller
{
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required'
        ])->validateWithBag('store');

        EmploymentHistory::create($request->all());

        return redirect()->route('curriculum');
    }

    public function update(Request $request, EmploymentHistory $employmentHistory)
    {
        \Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required'
        ])->validateWithBag('store');

        $employmentHistory->update($request->all());

        return redirect()->route('curriculum');
    }

    public function destroy(EmploymentHistory $employmentHistory)
    {
        $employmentHistory->delete();

        return redirect()->route('curriculum');
    }
}
