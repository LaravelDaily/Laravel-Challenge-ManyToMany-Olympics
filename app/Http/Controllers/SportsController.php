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
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(Request $request)
    {
        $sports = Sport::all();
        foreach($sports as $sport) {
            $firstPlace = Country::find($request->input('first'.$sport->id));
            $secondPlace = Country::find($request->input('second'.$sport->id));
            $thirdPlace = Country::find($request->input('third'.$sport->id));

            if($firstPlace && $secondPlace && $thirdPlace){
                $sport->countries()->attach(
                    [
                        $thirdPlace->id => ['place' => 3],
                        $secondPlace->id => ['place' => 2],
                        $firstPlace->id => ['place' => 1]
                    ]);
                //Reverse order because attaching the last one if country repeats,gold (best medal) is priority
            }
        }
        return redirect()->route('show');
    }

    public function show()
    {
        $results = array();
        $countries = Country::withCount('sports')
            ->having('sports_count', '>',0)
            ->get();

        foreach($countries as $country){
            $countryGold = $country->sports()->wherePivot('place','=', 1)->count();
            $countrySilver = $country->sports()->wherePivot('place','=', 2)->count();
            $countryBronze = $country->sports()->wherePivot('place','=', 3)->count();

            $results[] =array(
                'id' => $country->id,
                'name' => $country->name,
                'countryGold' => $countryGold,
                'countrySilver' => $countrySilver,
                'countryBronze' => $countryBronze);
        }
        usort($results, function($a, $b) {
            return [$b['countryGold'], $b['countrySilver'], $b['countryBronze']]
                <=>
                [$a['countryGold'], $a['countrySilver'], $a['countryBronze']];
        });
        return view('sports.show', compact( 'results'));

    }
}
