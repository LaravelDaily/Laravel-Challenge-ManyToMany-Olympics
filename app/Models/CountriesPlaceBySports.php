<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountriesPlaceBySports extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = "countries_place_by_sports";

}
