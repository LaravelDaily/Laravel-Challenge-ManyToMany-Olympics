<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(Request $request)
    {
        // Add your code here

        foreach ($request['scores'] as $key => $value) {
            // $key => sports
            // $value => country, place
        }

        return redirect()->route('show');
    }

    public function show()
    {
        // Add your code here

        return view('sports.show');
    }
}
