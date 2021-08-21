<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_sport', 'sport_id', 'country_id')
            ->withPivot('place');
    }
}
