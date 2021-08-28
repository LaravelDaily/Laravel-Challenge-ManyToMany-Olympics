<?php

namespace App\Http\Controllers;

use App\Http\Requests\SportsRequest;
use App\Models\CountrySport;
use App\Models\Sport;
use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SportsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    /**
     * @param SportsRequest $request
     * @return RedirectResponse
     */
    public function store(SportsRequest $request): RedirectResponse
    {
        // Add your code here
        $save_data_array = [];
        $now = now();
        foreach ($request->validated() as $key => $countries) {
            $sport = Sport::query()->where('name', '=', $key)->firstOrFail();
            foreach ($countries as $place => $country) {
                array_push($save_data_array, [
                    'sport_id' => $sport->id,
                    'country_id' => $country,
                    'place' => $place,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
        CountrySport::query()->insert($save_data_array);

        return redirect()->route('show');
    }

    /**
     * @return Application|Factory|View
     */
    public function show()
    {
        // Add your code here
        $countries = Country::query()
             ->has('medals')
            ->withCount([
                'firstPlace',
                'secondPlace',
                'thirdPlace'
            ])
            ->orderBy('first_place_count', 'desc')
            ->orderBy('second_place_count', 'desc')
            ->orderBy('third_place_count', 'desc')
            ->get();
        return view('sports.show', [
            'countries' => $countries
        ]);
    }
}
