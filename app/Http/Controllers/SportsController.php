<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Sport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    /**
     * Sports store method
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $values = $request->except('_token');

        foreach ($values as $key => $countryId) {
            if ($countryId) {
                $keyExplode = explode('-', $key);

                $place = $keyExplode[0];
                $sport = Sport::find($keyExplode[1]);

                $sport->countries()->attach($countryId, ['place' => $place]);
            }
        }

        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::with('sports')->get();

        foreach ($countries as $key => $country) {
            if (count($country->sports)) {
                $country->setMedalAmount();
            } else {
                $countries->forget($key);
            }
        }

        $countries = $countries->sortBy([
            ['first_place_amount', 'desc'],
            ['second_place_amount', 'desc'],
            ['third_place_amount', 'desc'],
        ]);

        return view('sports.show', compact('countries'));
    }
}
