<?php

namespace App\Actions\Sport;

use App\Models\Country;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetCountryMedalsAction
{
    public function handle(): Collection
    {
        return Country::query()
            ->withCount([
                'medals as countries_gold_count' => $this->withMedalsCountCallback('gold'),
                'medals as countries_silver_count' => $this->withMedalsCountCallback('silver'),
                'medals as countries_bronze_count' => $this->withMedalsCountCallback('bronze'),
            ])
            ->orderByDesc('countries_gold_count')
            ->orderByDesc('countries_silver_count')
            ->orderByDesc('countries_bronze_count')
            ->get();
    }

    protected function withMedalsCountCallback(string $medal): Closure
    {
        return function (Builder $query) use ($medal) {
            $query->where('medal', $medal);
        };
    }
}
