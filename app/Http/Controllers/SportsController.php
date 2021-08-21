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
        $sports = Sport::all();
        $countries = Country::all();
        $places = get_places();
        return view('sports.create', compact('sports', 'countries', 'places'));
    }

    public function store(ScoreCountryRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                foreach ($request->score as $sportId => $data) {
                    $sport = Sport::findOrFail($sportId);
                    $sport->countries()->attach($data);
                }
            });
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }
        return redirect()->route('show');
    }

    public function show()
    {
        $places = get_places();
        $countries = Country::query()
            ->withCountPlace()
            ->orderByCountPlace()
            ->havingCountPlace()
            ->take(5)
            ->get();

        return view('sports.show', compact('countries', 'places'));
    }
}
