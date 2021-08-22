<?php

namespace App\Http\Controllers;

use App\Events\CountryGotMedalEvent;
use App\Models\Sport;
use App\Models\Country;
use App\Models\medal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::table('countries_sports')->truncate(); // TO EMPTY THE TABLE BEFORE SUBMITTING THE FORM

        

        $sports = Sport::all();
        $country = new Country;
        foreach ($sports as $sport) {
            $sportName = $sport->name;
            $sportID = $sport->id;
            foreach ($request[$sportName] as $rank => $countryID) {
                $medal = $this->rankToMedal($rank);
                $country->sports()->attach(id: $countryID, attributes: ["medal" => $medal, "sport_id" => $sportID, "country_id" => $countryID]);
                event(new CountryGotMedalEvent($country ,$medal));
            }
        } 

        return redirect()->route('show');
    }

    public function show()
    {
        $country = Country::where("count_gold", ">", 0)
        ->orWhere("count_silver", ">", 0)
        ->orWhere("count_bronze", ">", 0)
        ->orderByDesc("count_gold")
        ->orderByDesc("count_silver")
        ->orderByDesc("count_bronze")
        ->get();



        return view('sports.show')->with("countries", $country);
    }


    private function rankToMedal($rank)
    {
        switch ($rank) {
            case 'first':
                return Medal::GOLD;

            case 'second':
                return Medal::SILVER;

            case 'third':
                return Medal::BRONZE;
        }
    }
    
}
