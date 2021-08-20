<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCountriesPlaceBySportsRequest;
use App\Models\CountriesPlaceBySports;
use App\Models\Country;
use App\Models\Sport;
use Illuminate\Support\Facades\DB;

class SportsController extends Controller
{

    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();
        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(StoreCountriesPlaceBySportsRequest $request)
    {

        $parsed_request = $this->parseStoreRequest($request);
        $parsed_request = $this->addCountryIdToParsedRequest($parsed_request);

        CountriesPlaceBySports::upsert($parsed_request, ["place", "sport_id"], ["country_id"]);
        return redirect()->route('show');
    }

    public function show()
    {

        $places_by_countries = Country::select(
            "name",
            DB::raw("(SELECT count(countries_place_by_sports.id)  from countries_place_by_sports where place = 1 and country_id = countries.id) as gold_count"),
            DB::raw("(SELECT count(countries_place_by_sports.id)  from countries_place_by_sports where place = 2 and country_id = countries.id) as silver_count"),
            DB::raw("(SELECT count(countries_place_by_sports.id)  from countries_place_by_sports where place = 3 and country_id = countries.id) as bronze_count")
        )
            ->having("bronze_count", "<>", 0)
            ->orHaving("silver_count", "<>", 0)
            ->orHaving("gold_count", "<>", 0)

            ->orderByDesc("gold_count")
            ->orderByDesc("silver_count")
            ->orderByDesc("bronze_count")
            ->get();

        return view('sports.show', ["places_by_countries" => $places_by_countries]);
    }

    private function parseStoreRequest(StoreCountriesPlaceBySportsRequest $request): array
    {
        $data = $request->only('sports');
        $result = [];
        foreach ($data['sports'] as $sport_id => $places) {
            foreach ($places as $place => $country_code) {

                $result[] = ['place' => $place, 'country_code' => $country_code, "sport_id" => $sport_id];
            }
        }
        return $result;
    }

    private function addCountryIdToParsedRequest(array $parsed_request): array
    {
        $country_ids = Country::whereIn("short_code", array_column($parsed_request, "country_code"))->pluck("id", "short_code");

        foreach ($parsed_request as $key => $value) {
            $parsed_request[$key]["country_id"] = $country_ids[$value['country_code']];
            unset($parsed_request[$key]["country_code"]);
        }
        return $parsed_request;

    }
}
