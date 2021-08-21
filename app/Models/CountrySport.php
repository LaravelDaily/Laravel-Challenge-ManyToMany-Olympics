<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountrySport extends Model
{
    use HasFactory;

    protected $table = "country_sport";

    protected $fillable = ['country_id','sport_id','first','second','third'];

  
}
