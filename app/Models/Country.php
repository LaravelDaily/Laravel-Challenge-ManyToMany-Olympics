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
}
