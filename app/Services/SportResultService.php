<?php

namespace App\Services;

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
}