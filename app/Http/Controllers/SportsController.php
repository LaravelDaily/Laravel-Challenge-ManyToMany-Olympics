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
        $places = get_places();
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
                    if ($sport) {
                        $sport->countries()->attach($data);
                    } else {
                        abort(404);
                    }
                }
            });
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }
        cache()->forget('top_countries');
        return redirect()->route('show');
    }

    public function show()
    {
        $places = get_places();
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
