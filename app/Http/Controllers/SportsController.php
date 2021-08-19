<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function index()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.index', compact('sports', 'countries'));
    }

    public function store(Request $request)
    {
        
        return redirect()->route('show');
    }

    public function show()
    {
        return view('sports.show');
    }
}
