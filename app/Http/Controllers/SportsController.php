<?php

namespace App\Http\Controllers;

use App\Actions\CurrentMedalAction;
use App\Models\Sport;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        foreach ($request->all()['sports'] as $sport_id => $rank) {
            if (!$rank[0] || !$rank[1] || !$rank[2]) {
                continue;
            }

            $sport = Sport::with('countries')->findOrFail($sport_id);
            $sport->countries()->syncWithoutDetaching([
                $rank[0] => ['gold' => CurrentMedalAction::handle($sport, $rank[0], 'gold') + 1],
                $rank[1] => ['silver' => CurrentMedalAction::handle($sport, $rank[1], 'silver') + 1],
                $rank[2] => ['bronze' => CurrentMedalAction::handle($sport, $rank[2], 'bronze') + 1],
            ]);
        }

        return redirect()->route('show');
    }

    public function show()
    {
        $rank = DB::table('medals')
            ->selectRaw('countries.name, sum(gold) as total_gold, sum(silver) as total_silver, sum(bronze) as total_bronze')
            ->join('countries', 'medals.country_id', '=', 'countries.id')
            ->orderByDesc('total_gold')
            ->orderByDesc('total_silver')
            ->orderByDesc('total_bronze')
            ->groupBy('country_id')
            ->get();

        return view('sports.show', compact('rank'));
    }
}
