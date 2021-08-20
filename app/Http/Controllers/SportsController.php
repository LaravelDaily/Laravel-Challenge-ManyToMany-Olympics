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
        $countries = Country::select('short_code','name')->get();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(Request $request)
    {
        $sports = Sport::all();
        $countriesIds = Country::pluck('id','short_code');

        if ($request->has('first')) {
            //first
            $inputData = $request->input('first');
            $data = [];
            foreach ($inputData as $sport => $country_code) {
                if (!isset($countriesIds[$country_code])) {
                    continue;
                }
                $countryId = $countriesIds[$country_code];
                $data[$sport][] = [$countryId => ['place'=>'first']];
            }

            foreach ($data as $sport => $countryData) {
                $sport = $sports->where('name',$sport)->first();
                $sport->countries()->attach($countryData[0]);
            }
        }

        if ($request->has('second')) {
            //second
            $inputData = $request->input('second');
            $data      = [];
            foreach ($inputData as $sport => $country_code) {
                if (!isset($countriesIds[$country_code])) {
                    continue;
                }
                $countryId      = $countriesIds[$country_code];
                $data[$sport][] = [$countryId => ['place' => 'second']];
            }

            foreach ($data as $sport => $countryData) {
                $sport = $sports->where('name', $sport)->first();
                $sport->countries()->attach($countryData[0]);
            }
        }

        if ($request->has('third')) {
            //third
            $inputData = $request->input('third');
            $data      = [];
            foreach ($inputData as $sport => $country_code) {
                if (!isset($countriesIds[$country_code])) {
                    continue;
                }
                $countryId      = $countriesIds[$country_code];
                $data[$sport][] = [$countryId => ['place' => 'third']];
            }

            foreach ($data as $sport => $countryData) {
                $sport = $sports->where('name', $sport)->first();
                $sport->countries()->attach($countryData[0]);
            }
        }
        return redirect()->route('show');
    }

    public function show()
    {
        // Add your code here

        $countries = Country::withCount(['sports as gold' => function($query){
            $query->where('place','first');
        }])->withCount(['sports as silver' => function($query){
            $query->where('place','second');
        }])->withCount(['sports as bronze' => function($query){
            $query->where('place','third');
        }])
            ->orderByDesc('gold')
            ->orderByDesc('silver')
            ->orderByDesc('bronze')
            ->get();

        return view('sports.show',compact('countries'));
    }
}
