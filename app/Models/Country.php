<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'country_sport', 'country_id', 'sport_id')
            ->withPivot('place');
    }

    public function getFirstCountAttribute()
    {
        return $this->sports->filter(function($value) {
            return $value->pivot->place === 'first';
        })
            ->count();
    }

    public function getSecondCountAttribute()
    {
        return $this->sports->filter(function($value) {
            return $value->pivot->place === 'second';
        })
            ->count();
    }

    public function getThirdCountAttribute()
    {
        return $this->sports->filter(function($value) {
            return $value->pivot->place === 'third';
        })
            ->count();
    }
}
