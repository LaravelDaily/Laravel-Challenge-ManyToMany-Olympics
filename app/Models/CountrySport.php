<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CountrySport extends Pivot
{
    public function sports()
    {
        return $this->hasMany(Sport::class, 'id', 'sport_id');
    }

    public function countries()
    {
        return $this->hasMany(Country::class, 'id', 'country_id');
    }
}
