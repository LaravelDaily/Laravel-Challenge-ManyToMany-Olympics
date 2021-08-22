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
        $winners = ['first' => $request->first, 'second' => $request->second, 'third' => $request->third];
        foreach ($winners as $place => $winner) {
            foreach ($winner as $sportId => $countryId) {
                $country = Country::find($countryId);
                $country->medals()->attach($sportId, ['place' => $place]);
            }
        }
        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::has('medals')->withCount(['gold', 'silver', 'bronze'])->get()->sortBy(function($country){
            return $country->gold->count() || $country->silver->count() || $country->bronze->count();
        });
        return view('sports.show', ['countries' => $countries]);
    }
}