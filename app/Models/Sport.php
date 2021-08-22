<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function winners()
    {
        return $this->belongsToMany(Country::class, 'medal_winners', 'sport_id', 'country_id')->as('winners')->withPivot('place');
    }
    public function gold()
    {
        return $this->belongsToMany(Country::class, 'medal_winners')->wherePivot('place', 'first');
    }
    public function silver()
    {
        return $this->belongsToMany(Country::class, 'medal_winners')->wherePivot('place', 'second');
    }
    public function bronze()
    {
        return $this->belongsToMany(Country::class, 'medal_winners')->wherePivot('place', 'third');
    }
}