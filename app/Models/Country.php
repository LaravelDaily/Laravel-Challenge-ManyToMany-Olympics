<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];

    /*==== Relationship Start ====*/

    /**
     * Get related sports of owned medals
     *
     * @return BelongsToMany
     */
    public function ownMedalsInSports(): BelongsToMany
    {
        return $this->belongsToMany(Sport::class, 'medals')
            ->as('medals')
            ->using(Medal::class)
            ->withPivot([
                'gold',
                'silver',
                'bronze'
            ])
            ->withTimestamps();
    }

    /*==== Relationship End ====*/
}
