<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Sport;

class SportServiceProvider
{
    public function insertRatings(array $request)
    {
        $sports = Sport::get(['name', 'id']);

        foreach ($sports as $sport) {
            //get country codes from request
            $firstCountryCode = $this->getCode($request,$sport,'first');
            $secondCountryCode = $this->getCode($request, $sport, 'second');
            $thirdCountryCode = $this->getCode($request, $sport, 'third');

            //get country id by country short_code 
            $firstCountryId = Country::getId('short_code', $firstCountryCode);
            $secondCountryId = Country::getId('short_code', $secondCountryCode);
            $thirdCountryId = Country::getId('short_code', $thirdCountryCode);

            //make an array for syncing to database
            $rankings = $this->getRanks([
                $firstCountryId, $secondCountryId, $thirdCountryId
            ]);

            $sport->countries()->sync($rankings);
        }
    }

    private function getRanks(array $countryIds): array
    {
        $index = 1;

        $rankings = [];
        foreach ($countryIds as $countryId) {
            $rankings[$countryId] = ['rank' => $index];
            $index++;
        }

        return $rankings;
    }

    private function getCode(array $request,object $sport,string $rank): string
    {
        return $request[$sport->name][$rank];
    }
}
