<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function countries_by_sports()
    {
        return $this->belongsToMany(Country::class)->using(CountriesPlaceBySports::class);
    }
}
