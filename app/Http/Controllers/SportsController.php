<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ScoreCountryRequest;

class SportsController extends Controller
{
    public function create()
    {
        $places = places();

        $countries = cache()->rememberForever('countries', function () {
            return Country::all();
        });

        $sports = cache()->rememberForever('sports', function () {
            return Sport::all();
        });

        return view('sports.create', compact('sports', 'countries', 'places'));
    }

    public function store(ScoreCountryRequest $request)
    {
        $sports = cache('sports');

        try {
            DB::transaction(function () use ($request, $sports) {
                foreach ($request->score as $sportId => $data) {
                    $sport = $sports->find($sportId);
                    
                    abort_unless($sport, 404, 'Sport not found');

                    $sport->countries()->attach($data);
                }
            });

            cache()->forget('top_countries');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('show');
    }

    public function show()
    {
        $places = places();
        // Can remove line 36 in code and replace `rememberForever` to `remember` and add time for query if the If there are many places to enter a place into the country
        $countries = cache()->rememberForever('top_countries', function () {
            return Country::query()
                ->withCountPlace()
                ->orderByCountPlace()
                ->havingCountPlace()
                ->take(5)
                ->get();
        });

        return view('sports.show', compact('countries', 'places'));
    }
}
