<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::with('sports')->get();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(Request $request)
    {
        // loop over scores
        /*
         *
         * scores: [
         *  1 => [ // sport_id
         *      "first" => "3", // place => country
         *      "second" => "6",
         *      "third" => "8"
         *   ],
         *   ...
         * ]
         */

        foreach ($request['scores'] as $key => $value) {
            // $key is equivalent to sport_id
            // $value is an array of [place => country_id]

            // query for the sport object
            // sync with country_id and place
            //
            //  $countryId = $value['first'];
            //  sport->countries()->sync($countryId, ['place' => 'first']);

            //  $countryId = $value['second'];
            //  sport->countries()->sync($countryId, ['place' => 'second']);

            //  $countryId = $value['third'];
            //  sport->countries()->sync($countryId, ['place' => 'third']);
        }

        return redirect()->route('show');
    }

    public function show()
    {
        // Add your code here

        return view('sports.show');
    }
}
