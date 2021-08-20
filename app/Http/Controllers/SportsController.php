<?php

namespace App\Http\Controllers;

use App\Http\Requests\SportsStoreRequest;
use App\Models\Medal;
use App\Models\Sport;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();
        $medal_names = Medal::NAMES;

        return view('sports.create', compact('sports', 'countries', 'medal_names'));
    }

    public function store(SportsStoreRequest $request)
    {
        // Added my own code here
        // return $request->all();

        DB::transaction(function () use ($request) {
            foreach (Medal::NAMES as $medal_name) {

                foreach ($request[Str::plural($medal_name)] as $sport_id => $country_id) {
                    $country_query = Sport::find($sport_id)
                        ->ownMedalsCountries();

                    $existed_country = $country_query
                        ->find($country_id);

                    // check country already own any medals
                    if ($existed_country) {
                        // increment medal value
                        $existed_country->medals->increment($medal_name);
                    } else {
                        // not owned any medals
                        // attach new medal value
                        $country_query->attach($country_id, [$medal_name => 1]);
                    }
                }
            }
        });

        return redirect()->route('show');
    }

    public function show()
    {
        // Added my own code here

        $medal_names = Medal::NAMES;

        $countries_query = Country::query()
            ->has('ownMedalsInSports');

        foreach ($medal_names as $medal_name) {

            $plural_medal_name = Str::plural($medal_name);

            // add sum of each medals and order by medal list
            $countries_query->withSum('ownMedalsInSports as ' . $plural_medal_name, 'medals.' . $medal_name)
                ->orderByDesc($plural_medal_name);
        }

        $countries = $countries_query->get();

        return view('sports.show', compact('countries', 'medal_names'));
    }
}
