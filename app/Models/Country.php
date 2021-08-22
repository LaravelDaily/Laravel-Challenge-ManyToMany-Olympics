<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code',"count_gold","count_Silver","count_bronze"];

    public function sports()
    {
        return $this->belongsToMany(Sport::class,  "countries_sports", "country_id", "sport_id")
        ->withPivot(["medal"]);
    }
}
