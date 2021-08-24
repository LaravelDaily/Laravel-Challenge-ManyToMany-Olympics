<?php

namespace App\Http\Controllers;

use App\Http\Requests\sport\SportStoreRequest;
use App\Models\Sport;
use App\Models\Country;
use App\Services\SportServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::get('name')
            ->map(fn ($item) => $item->name);

        $countries = DB::table('countries')->get(['name', 'short_code']);

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(SportStoreRequest $request)
    {
        (new SportServiceProvider)->insertRatings($request->validated());

        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::countMedals()
            ->orderByMedal()
            ->take(5)
            ->get();

        return view('sports.show', compact('countries'));
    }
}
