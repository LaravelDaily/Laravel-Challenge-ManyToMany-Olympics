<?php

namespace App\Http\Controllers;

use App\Actions\SportAction;
use App\Http\Requests\SportRequest;
use App\Models\Sport;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all(['id', 'name']);
        $countries = Country::all(['id', 'short_code', 'name']);

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(SportRequest $request, SportAction $sportAction): RedirectResponse
    {
        $sportAction->store($request);

        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::withCount(['sports as gold_count' => fn ($q) => $q->where('country_sport.place', Sport::MEDAL_GOLD)])
            ->withCount(['sports as silver_count' => fn ($q) => $q->where('country_sport.place', Sport::MEDAL_SILVER)])
            ->withCount(['sports as bronze_count' => fn ($q) => $q->where('country_sport.place', Sport::MEDAL_BRONZE)])
            ->orderBy('gold_count', 'desc')
            ->orderBy('silver_count', 'desc')
            ->orderBy('bronze_count', 'desc')
            ->limit(5)
            ->get();

        return view('sports.show', compact('countries'));
    }
}
