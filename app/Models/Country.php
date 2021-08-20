<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'short_code'];
    /**
     * The sports that belong to the Sport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'country_sport')->withPivot(['type_score']);
    }

    public function scopeWithCountSport($query)
    {
        return $query->withCount([
            'sports as gold_count' => function ($query) {
                $query->where('type_score', 1);
            },
            'sports as silver_count' => function ($query) {
                $query->where('type_score', 2);
            },
            'sports as bronze_count' => function ($query) {
                $query->where('type_score', 3);
            },
        ]);
    }
}
