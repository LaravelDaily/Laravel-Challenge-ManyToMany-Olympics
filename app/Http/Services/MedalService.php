<?php

namespace App\Http\Services;

use App\Models\Country;
use App\Models\Medal;
use App\Models\Sport;

class MedalService
{
    public const GOLD = 1;
    public const SILVER = 2;
    public const BRONZE = 3;

    public function update($countryCode, $sportsId, $ranking)
    {
        $country = Country::where('short_code', $countryCode)->first();
        if (!$country) return;

        $sport = Sport::find($sportsId);
        if (!$sport) return;

        $medal = Medal::where('sports_id', $sportsId)->where('ranking', $ranking)->first();

        // Create new medal if it doesn't exist
        if (!$medal) $medal = new Medal();

        $medal->sports()->associate($sport);
        $medal->country()->associate($country);
        $medal->ranking = $ranking;
        $medal->save();
    }
}
