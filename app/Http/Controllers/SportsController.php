<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use App\Models\Result;
use Illuminate\Http\Request;

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
        $sports = Sport::all();
        foreach ($sports as $sport) {

            $sport_id = $sport->id;
            foreach ($request->$sport_id as $key => $value) {
                
                $result = new Result();

                $result->country_id = $value;
                $result->sport_id   = $sport->id;
                $result->result     = $key;
                $result->save();

            }

        }

        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::with('results')->get();

        return view('sports.show',compact('countries'));
    }
}
