<?php

namespace App\Http\Controllers;

use App\Actions\Sport\GetCountryMedalsAction;
use App\Models\Sport;
use App\Models\Country;

class SportsController extends Controller
{
    public function create()
    {
        return view('sports.create')
            ->with('sports', Sport::query()
                ->with('countries')
                ->get());
    }

    public function show(GetCountryMedalsAction $action)
    {
        return view('sports.show')
            ->with('countries', $action->handle());
    }
}
