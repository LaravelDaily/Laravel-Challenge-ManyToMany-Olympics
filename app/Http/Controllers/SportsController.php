<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use App\Http\Services\MedalService;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(Request $request, MedalService $service)
    {
        foreach ($request->only(['first', 'second', 'third']) as $position => $countries) {
            // Set ranking to GOLD/SILVER/BRONZE depending on if the position is first, second or third
            $ranking = $position === 'first' ? MedalService::GOLD : ($position === 'second' ? MedalService::SILVER : MedalService::BRONZE);

            foreach ($countries as $sportsId => $countryCode) {
                $service->update($countryCode, $sportsId, $ranking);
            }
        }

        return redirect()->route('show');
    }

    public function show()
    {
        // Add your code here

        $countries = Country::withCount('medals')->having('medals_count', '>', 0)->get();

        return view('sports.show', compact('countries'));
    }
}
