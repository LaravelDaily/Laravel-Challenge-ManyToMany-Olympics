<?php

namespace App\Services;

use App\Enums\Medal;
use App\Models\Country;
use App\Models\Sport;
use Exception;

class SportResultService
{
    public function getSportById(int $id): ?Sport
    {
        return Sport::find($id);
    }

    public function applySportResult(Sport $sport, int $countryId, string $result): bool
    {
        try {
            $sport->countries()->attach($countryId, [
                'medal' => $result,
            ]);

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    public function getCountriesWithSportResults()
    {
        return Country::has('sports')
            ->withCount([
                'sports as gold_count' => function ($query) {
                    $query->where('medal', Medal::GOLD);
                },
                'sports as silver_count' => function ($query) {
                    $query->where('medal', Medal::SILVER);
                },
                'sports as bronze_count' => function ($query) {
                    $query->where('medal', Medal::BRONZE);
                },
            ])
            ->orderBy('gold_count', 'desc')
            ->orderBy('silver_count', 'desc')
            ->orderBy('bronze_count', 'desc')
            ->get();
    }
}
