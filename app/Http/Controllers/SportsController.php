<?php

namespace App\Http\Controllers;

use App\Enum\Medal;
use App\Http\Requests\StoreSportRequest;
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

    public function store(StoreSportRequest $request)
    {
        if($request->has('sports')) {
            $sports = Sport::all();
            foreach($request->sports as $sport_id=>$medals) {
                $sport = $sports->find($sport_id);
                    foreach ($medals as $medal=>$country_id) {
                        $sport->countries()->attach($country_id, ['medal' => $medal]);
                    }
            }
        }
        return redirect()->route('show');
    }

    public function show()
    {
        $results = Country::has('sports')
                    ->withCount(['sports as gold' => function($query){
                        $query->where('medal', Medal::GOLD);
                    },
                    'sports as silver' => function($query){
                        $query->where('medal', Medal::SILVER);
                    },
                    'sports as bronze' => function($query) {
                        $query->where('medal', Medal::BRONZE);
                    }])
                    ->orderByDesc('gold')
                    ->orderByDesc('silver')
                    ->orderByDesc('bronze')
                    ->get();           
        return view('sports.show', compact('results'));
    }
}
