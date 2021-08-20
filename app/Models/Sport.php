<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // TODO:not quite the right place
    const MEDAL_GOLD = 1;
    const MEDAL_SILVER = 2;
    const MEDAL_BRONZE = 3;

    public function countries()
    {
        return $this->belongsToMany(Country::class)->withPivot('place')->withTimestamps();
    }
}
