<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSportsRequest;
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

    public function store(StoreSportsRequest $request)
    {
        $sports = Sport::all();

        foreach ($request->sports as $sport_id => $countries) {
            $sport = $sports->find($sport_id);
            $position = 1;
            foreach ($countries as $country) {
                $sport->countries()->attach($country, ['position' => $position]);
                $position++;
            }
        }

        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::has('sports')
            ->withCount([
                'sports as gold' => function ($query) {
                    $query->where('position', 1);
                },
                'sports as silver' => function ($query) {
                    $query->where('position', 2);
                },
                'sports as bronze' => function ($query) {
                    $query->where('position', 3);
                },
            ])
            ->orderByDesc('gold')
            ->orderByDesc('silver')
            ->orderByDesc('bronze')
            ->get();

        return view('sports.show', compact('countries'));
    }
}
