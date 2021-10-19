<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedalsRequest;
use App\Models\CountrySportMedal;
use App\Models\Medal;
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

    public function store(StoreMedalsRequest $request)
    {
        $medals_arr = Medal::selectRaw('LOWER(name) as name,id')->pluck('id', 'name');
        // Add your code here
        foreach ($request->input('medals') as $sport_id => $sport) {
            foreach ($sport as $medals => $country_id) {
                CountrySportMedal::insert([
                    'country_id' => $country_id,
                    'sport_id' => $sport_id,
                    'medal_id' => $medals_arr[$medals]
                ]);
            }
        }
        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country
            ::withCount('gold')
            ->withCount('sliver')
            ->withCount('bronze')
            ->orderByDesc('gold_count')
            ->orderByDesc('sliver_count')
            ->orderByDesc('bronze_count')
            ->limit(5)
            ->get();

        return view('sports.show', compact('countries'));
    }
}
