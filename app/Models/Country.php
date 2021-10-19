<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];

    public function gold()
    {
        return $this->hasMany(CountrySportMedal::class)->where('medal_id', Medal::GOLD);
    }
    public function sliver()
    {
        return $this->hasMany(CountrySportMedal::class)->where('medal_id', Medal::SLIVER);
    }
    public function bronze()
    {
        return $this->hasMany(CountrySportMedal::class)->where('medal_id', Medal::BRONZE);
    }
}
