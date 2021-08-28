<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];

    public function medals(): BelongsToMany
    {
        return $this->belongsToMany(
            Sport::class,
            'country_sports',
            'country_id',
            'sport_id');
    }

    /**
     * @return BelongsToMany
     */
    public function firstPlace(): BelongsToMany
    {
        return $this->belongsToMany(
            Sport::class,
            'country_sports',
            'country_id',
            'sport_id')
            ->where('place', '=' , 1);
    }
    /**
     * @return BelongsToMany
     */
    public function secondPlace(): BelongsToMany
    {
        return $this->belongsToMany(
            Sport::class,
            'country_sports',
            'country_id',
            'sport_id')
            ->where('place', '=' , 2);
    }
    /**
     * @return BelongsToMany
     */
    public function thirdPlace(): BelongsToMany
    {
        return $this->belongsToMany(
            Sport::class,
            'country_sports',
            'country_id',
            'sport_id')
            ->where('place', '=' , 3);
    }
}
