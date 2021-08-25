<?php

namespace App\Action;

use DB;
use Illuminate\Support\Carbon;
use App\Models\{Country, Sport};
use Illuminate\Support\Facades\Cache;

class SportAction
{
    public const RANKING_SCORE = [
        'first'  => 1,
        'second' => 2,
        'third'  => 3,
    ];

    public function __construct()
    {
        $this->sports    = $this->retrieveSports();
        $this->countries = $this->loadCountries();

        $this->data      = collect();
        $this->rankings  = request('sports');
    }

    public function loadCountries()
    {
        return Cache::get(
            'country_list',
            Cache::remember('country_list', Carbon::now()->add('1 days')->diffInSeconds(now()), function () {
                return Country::toBase()->select(['id', 'short_code'])->pluck('id', 'short_code');
            })
        );
    }

    public function retrieveSports()
    {
        $sportsNames = collect(request()->sports)->keys();

        return Sport::query()->whereIn('name', $sportsNames)->pluck('id', 'name');
    }

    public function save(): void
    {
        $this->sports->each(function ($sportId, $name) {
            $this->process(
                ['countryRanking' => $this->rankings[$name]] + compact('sportId')
            );
        });

        DB::table('country_sport')->insert($this->data->all());
    }

    public function process($arguments): void
    {
        ['countryRanking' => $countryRanking, 'sportId' => $sportId] = $arguments;

        collect($countryRanking)->each(function ($value, $rank) use ($sportId) {
            $this->data->push([
                'country_id' => $this->countries[$value],
                'sport_id'   => $sportId,
                'ranking'    => self::RANKING_SCORE[$rank],
            ]);
        });
    }
}
