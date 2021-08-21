<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * @return BelongsToMany
     */
    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'country_sport')->withPivot(['type_score']);
    }

    public function scopeWithCountPlace($query)
    {
        $places = get_places();
        foreach ($places as $index => $place) {

            $query->withCount([
                'sports as ' . $place['type'] . '_count' => function ($query) use ($index) {
                    $query->where('type_score', ($index + 1));
                },
            ]);
        }
        return $query;
    }

    public function scopeOrderByCountPlace($query)
    {
        $places = get_places();
        foreach ($places as $index => $place) {
            $query->orderByDesc($place['type'] . '_count');
        }
        return $query;
    }

    public function scopeHavingCountPlace($query)
    {
        $places = get_places();
        foreach ($places as $index => $place) {
            $query->orhaving($place['type'] . '_count', '<>', 0);
        }
        return $query;
    }
}
