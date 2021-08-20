<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use App\Http\Requests\ScoreCountryRequest;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();
        $places = ['1st', '2nd', '3rd'];
        return view('sports.create', compact('sports', 'countries', 'places'));
    }

    public function store(ScoreCountryRequest $request)
    {
        foreach ($request->score as $sportId => $data) {
            $sport = Sport::findOrFail($sportId);
            $sport->countries()->attach($data);
        }
        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::query()
            ->withCountSport()
            ->orderByDesc('gold_count')
            ->orderByDesc('silver_count')
            ->orderByDesc('bronze_count')
            ->take(5)
            ->get();

        return view('sports.show', compact('countries'));
    }
}
