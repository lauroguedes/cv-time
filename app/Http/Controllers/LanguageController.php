<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required'
        ])->validateWithBag('store');

        Language::create($request->all());

        return redirect()->route('curriculum');
    }

    public function update(Request $request, Language $language)
    {
        \Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required'
        ])->validateWithBag('store');

        $language->update($request->all());

        return redirect()->route('curriculum');
    }

    public function destroy(Language $language)
    {
        $language->delete();

        return redirect()->route('curriculum');
    }
}
