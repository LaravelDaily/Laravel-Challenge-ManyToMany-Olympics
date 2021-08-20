<?php

namespace App\Models;

use App\Models\CountriesPlaceBySports;
use App\Models\Sport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];

    public function countries_by_sports()
    {
        return $this->belongsToMany(Sport::class)->using(CountriesPlaceBySports::class);
    }
}
