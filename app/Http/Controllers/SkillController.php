<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required'
        ])->validateWithBag('store');

        Skill::create($request->all());

        return redirect()->route('curriculum');
    }

    public function update(Request $request, Skill $skill)
    {
        \Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required'
        ])->validateWithBag('store');

        $skill->update($request->all());

        return redirect()->route('curriculum');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('curriculum');
    }
}
