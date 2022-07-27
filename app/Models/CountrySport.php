<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountrySport extends Model
{
    use HasFactory;

    const GOLD_MEDAL = 'gold';
    const SILVER_MEDAL = 'silver';
    const BRONZE_MEDAL = 'bronze';

    protected $table = 'country_sport';

    protected $fillable = ['medal'];
}
