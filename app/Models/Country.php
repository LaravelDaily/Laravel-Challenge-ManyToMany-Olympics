<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];

    /**
     * Relationship with sports.
     *
     * @return BelongsToMany
     */
    public function sports(): BelongsToMany
    {
        return $this->belongsToMany(
            Sport::class,
            'countries_sports',
            'country_id',
            'sport_id'
        )
            ->withPivot(['place']);
    }

    /**
     * Setting medal amount of country
     *
     * @return void
     */
    public function setMedalAmount(): void
    {
        $sports = $this->sports;

        $this->first_place_amount = 0;
        $this->second_place_amount = 0;
        $this->third_place_amount = 0;

        foreach ($sports as $sport) {
            $place = (int)$sport->pivot->place;

            if ($place === 1) {
                ++$this->first_place_amount;
            } else if ($place === 2) {
                ++$this->second_place_amount;
            } else if ($place === 3) {
                ++$this->third_place_amount;
            }
        }
    }
}
