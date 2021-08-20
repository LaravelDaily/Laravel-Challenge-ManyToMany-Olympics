<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryMedal extends Model
{
    use HasFactory;

    protected $fillable = ['sports_id', 'gold', 'silver', 'bronze'];
}
