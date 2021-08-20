<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateRanksRequest;

class SportsController extends Controller
{   
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(UpdateRanksRequest $request)
    {   
        $requests = collect($request->except('_token'));

        $requests->each(function($code, $key) {
            list($rank, $sportId) = explode('--', $key);
            $country = Country::where('short_code', $code)->first();

            $country->achievements()->attach($sportId, ['medal' => ucfirst($rank)]);
        });

        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::withCount([
            'achievements as gold' => function($query) { $query->where('medal', 'Gold'); },
            'achievements as silver' => function($query) { $query->where('medal', 'Silver'); },
            'achievements as bronze' => function($query) { $query->where('medal', 'Silver'); },
        ])
        ->orderByDesc('gold')
        ->orderByDesc('silver')
        ->orderByDesc('bronze')
        ->get();

        return view('sports.show', compact('countries'));
    }
}
