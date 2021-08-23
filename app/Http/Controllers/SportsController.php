<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use App\Models\Medal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(Request $request)
    {
        // Add your code here
        $positions = $request->positionAll;

        foreach ($positions as $key => $value) {
            $countries = array_count_values($value);
            $medal = Medal::find($key);
            $medal->countries()->attach($this->mapCountries($countries));
        }

        return redirect()->route('show');
    }

    public function show()
    {
        // Add your code here
        $countries = Country::has('medals')
            ->withSum([
                'medals as gold_count'=> function (Builder $query) {
                    $query->where('medal_id',  1);
                }], 'country_medal.quantity'
            )
            ->withSum([
                'medals as silver_count'=> function (Builder $query) {
                    $query->where('medal_id',  2);
                }], 'country_medal.quantity'
            )
            ->withSum([
                'medals as bronze_count'=> function (Builder $query) {
                    $query->where('medal_id',  3);
                }], 'country_medal.quantity'
            )
            ->orderBy('gold_count', 'desc')
            ->orderBy('silver_count', 'desc')
            ->get();

        return view('sports.show', compact('countries'));
    }

    public function mapCountries($countries)
    {
        return collect($countries)->map(function ($i) {
            return ['quantity' => $i];
        });
    }
}
