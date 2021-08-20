<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use App\Models\CountryMedal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $country = new Country;

        foreach ($request->except('_token') as $key => $value) {

            // if user not select country it will be default 0

            $validator = Validator::make(
                ['values' => $value],
                [
                    "values"    => "required|array",
                    "values.*"  => "required|distinct|digits_between:1,3",
                ],
                [
                    'distinct' => 'Same Country Cant Have Same Medal',
                    "digits_between" => "Please Choose A Medal"
                ]
            );

            if ($validator->fails()) {
                return redirect()
                    ->route('create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $insert = [
                'sports_id' => $key,
                'gold' => $country->getId($value[0]),
                'silver' => $country->getId($value[1]),
                'bronze' => $country->getId($value[2]),
            ];
            CountryMedal::create($insert);
        }

        return redirect()->route('show');
    }

    public function show()
    {

        $countries = Country::withCount(['getGold', 'getSilver', 'getBronze'])
            ->orderBy('get_gold_count', 'desc')
            ->orderBy('get_silver_count', 'desc')
            ->orderBy('get_bronze_count', 'desc')
            ->limit(5)->get();

        return view('sports.show')->with('countries', $countries);
    }
}
