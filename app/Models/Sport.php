<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relationship with countries.
     *
     * @return BelongsToMany
     */
    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(
            Country::class,
            'countries_sports',
            'sport_id',
            'country_id'
        )
            ->withPivot(['place']);
    }
}
