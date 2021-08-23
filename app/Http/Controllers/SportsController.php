<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultRequest;
use App\Models\Sport;
use App\Models\Country;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(ResultRequest $request)
    {
        collect($request->get('results'))
            ->each(function (array $result) {
                $sport = Sport::query()->findOrFail($result['sport']);
                $sport->countries()->syncWithoutDetaching([$result['first'] => ['position' => 1]]);
                $sport->countries()->syncWithoutDetaching([$result['second'] => ['position' => 2]]);
                $sport->countries()->syncWithoutDetaching([$result['third'] => ['position' => 3]]);
            });

        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::query()
            ->has('sports')
            ->withCountGolds()
            ->withCountSilvers()
            ->withCountBronzes()
            ->latest('golds_count')
            ->get();

        return view('sports.show', compact('countries'));
    }
}
