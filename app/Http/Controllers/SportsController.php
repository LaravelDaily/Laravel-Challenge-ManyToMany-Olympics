<?php

namespace App\Http\Controllers;

use App\Http\Requests\SportCreateRequest;
use App\Models\Sport;
use App\Models\Country;

class SportsController extends Controller
{
  public function create()
  {
    $sports = Sport::all();
    $countries = Country::all();

    return view('sports.create', compact('sports', 'countries'));
  }

  public function store(SportCreateRequest $request)
  {
    foreach ($request->input('sports') as $sportId => $data) {
      $sport = Sport::findOrFail($sportId);
      foreach ($data as $medal => $countryId) {
        $sport->countries()->attach($countryId, [
          'medal' => $medal
        ]);
      }
    }

    return redirect()->route('sports.show');
  }

  public function show()
  {
    $countries = Country::with('sports')->mostRewarded()->get();

    return view('sports.show', compact('countries'));
  }
}
