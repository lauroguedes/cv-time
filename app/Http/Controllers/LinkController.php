<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'name' => 'required',
            'url' => 'required|url'
        ])->validateWithBag('store');

        Link::create($request->all());

        return redirect()->route('curriculum');
    }

    public function update(Request $request, Link $link)
    {
        \Validator::make($request->all(), [
            'name' => 'required',
            'url' => 'required|url'
        ])->validateWithBag('store');

        $link->update($request->all());

        return redirect()->route('curriculum');
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('curriculum');
    }
}
