<?php

namespace App\Http\Controllers;

use App\Models\EmploymentHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmploymentHistoryController extends Controller
{
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required'                                                                                                      
        ])->validate();                                                                                         

        EmploymentHistory::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return redirect()->route('curriculum');
    }

    public function update(Request $request, EmploymentHistory $employmentHistory)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required'                                                                                                      
        ])->validate();

        $employmentHistory->update([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return redirect()->route('curriculum');
    }
}
