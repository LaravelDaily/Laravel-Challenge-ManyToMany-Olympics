<?php

namespace App\Actions;

use App\Models\Sport;

class CurrentMedalAction
{
    private static $medals = ['gold', 'silver', 'bronze'];

    public static function handle(Sport $sport, int $country_id, string $medal = 'gold')
    {
        throw_if(!in_array($medal, self::$medals));

        return $sport->countries->where('id', $country_id)->first()?->pivot->{$medal};
    }
}