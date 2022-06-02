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
        return $this->belongsToMany(Sport::class)->withPivot(['type_score']);
    }

    public function scopeWithCountPlace($query)
    {
        $places = places();
        foreach ($places as $index => $place) {
            $query->withCount([
                'sports as ' . $place['type'] . '_count' => function ($query) use ($index) {
                    $query->where('type_score', ($index + 1));
                },
            ]);
        }

        return $query;
    }

    public function scopeOrderByCountPlace($query, $direction = 'Desc')
    {
        $places = places();
        foreach ($places as $place) {
            $query->orderBy($place['type'] . '_count', $direction);
        }

        return $query;
    }

    public function scopeHavingCountPlace($query, $operator = '<>', $value = 0)
    {
        $places = places();
        foreach ($places as $place) {
            $query->orHaving($place['type'] . '_count', $operator, $value);
        }

        return $query;
    }
}
