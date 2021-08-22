<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'short_code'];

    public function medals()
    {
        return $this->belongsToMany(Sport::class, 'medal_winners', 'country_id', 'sport_id')->as('medals')->withPivot('place');
    }
    public function gold()
    {
        return $this->belongsToMany(Sport::class, 'medal_winners')->wherePivot('place', 'first');
    }
    public function silver()
    {
        return $this->belongsToMany(Sport::class, 'medal_winners')->wherePivot('place', 'second');
    }
    public function bronze()
    {
        return $this->belongsToMany(Sport::class, 'medal_winners')->wherePivot('place', 'third');
    }
}