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
        return $this->belongsToMany(Sport::class,'country_sport', 'country_id', 'sport_id');
    }

    public function gold_medals()
    {
        return $this->hasMany(CountrySport::class,'first');
    }

    public function silver_medals()
    {
        return $this->hasMany(CountrySport::class,'second');
    }

    public function bronze_medals()
    {
        return $this->hasMany(CountrySport::class,'third');
    }
}
