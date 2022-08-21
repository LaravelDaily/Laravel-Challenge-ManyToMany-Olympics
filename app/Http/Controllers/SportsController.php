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
        $data = $request->except('_token');
        $sports = Sport::all();

        foreach ($sports as $sport) {
            $values = $data[$sport->id];
            foreach ($values as $medal => $countryID) {
                $sport->countries()->attach($countryID, ['medal' => $medal]);
            }
        }

        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::whereHas('sports')->withCount([
            'sports as gold_count' => fn ($query) => $query->where('country_sports.medal', 'gold'),
            'sports as silver_count' => fn ($query) => $query->where('country_sports.medal', 'silver'),
            'sports as bronze_count' => fn ($query) => $query->where('country_sports.medal', 'bronze'),
        ])
            ->orderByDesc('gold_count')
            ->orderByDesc('silver_count')
            ->orderByDesc('bronze_count')
            ->get();

        return view('sports.show', compact('countries'));
    }
}
