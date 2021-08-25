<?php

namespace App\Http\Controllers;

use App\Action\SportAction;
use App\Models\{Country, CountrySport, Sport};

class SportsController extends Controller
{
    public function __construct(SportAction $sport)
    {
        $this->sport = $sport;
    }

    public function create()
    {
        $sports    = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store()
    {
        $this->sport->save();

        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::query()->has('sports')
                    ->withCount([
                        'sports as first' => function ($query) {
                            $query->where('ranking', 1);
                        },
                        'sports as second' => function ($query) {
                            $query->where('ranking', 2);
                        },
                        'sports as third' => function ($query) {
                            $query->where('ranking', 3);
                        },
                    ])->get();

        return view('sports.show')->with(compact('countries'));
    }
}
