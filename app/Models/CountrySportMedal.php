<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountrySportMedal extends Model
{
    use HasFactory;
    protected $fillable=['country_id','sport_id','medal_id'];
}
