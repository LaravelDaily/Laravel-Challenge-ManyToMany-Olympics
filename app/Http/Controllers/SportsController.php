<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use App\Http\Requests\SportMedalsStoreRequest;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(SportMedalsStoreRequest $request)
    {
        $sports = $request->input('sport');
        $firsts = $request->input('first');
        $seconds = $request->input('second');
        $thirds = $request->input('third');
        
        foreach ($sports as $index => $sport_id){
            $sport = Sport::findOrFail($sport_id);
            $sport->countries()->sync([]);
            $sport->countries()->attach(
                Country::where('short_code', $firsts[$index])->firstOrFail()->id,
                ['position' => 1]
            );
            $sport->countries()->attach(
                Country::where('short_code', $seconds[$index])->firstOrFail()->id,
                ['position' => 2]
            );
            $sport->countries()->attach(
                Country::where('short_code', $thirds[$index])->firstOrFail()->id,
                ['position' => 3]
            );            
        }
        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::select(['name'])
            ->withCount('gold_medals')
            ->withCount('silver_medals')
            ->withCount('bronze_medals')
            ->havingRaw('gold_medals_count')
            ->orHavingRaw('silver_medals_count')
            ->orHavingRaw('bronze_medals_count')
            ->orderBy('gold_medals_count', 'desc')
            ->orderBy('silver_medals_count', 'desc')
            ->orderBy('bronze_medals_count', 'desc')
            ->orderBy('name', 'asc')
            ->get();
        return view('sports.show', compact('countries'));
    }
}
