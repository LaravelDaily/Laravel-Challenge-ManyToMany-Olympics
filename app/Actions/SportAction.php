<?php

namespace App\Actions;

use App\Http\Requests\SportRequest;
use App\Models\Country;
use App\Models\Sport;

class SportAction
{
    public function store(SportRequest $request)
    {
        foreach ($request->sport as $sport_id => $places) {

            $sport = Sport::findOrFail($sport_id);

            $p = collect($places)->filter()->flip()->map(fn ($v) => ['place' => $v])->all();
            $sport->countries()->sync($p);

        }
    }
}