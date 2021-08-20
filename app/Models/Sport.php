<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /*==== Relationship Start ====*/

    /**
     * Get related countries whom own medals
     *
     * @return BelongsToMany
     */
    public function ownMedalsCountries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'medals')
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
