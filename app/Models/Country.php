<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];

    protected $hidden = ['created_at', 'updated_at'];

    public function achievements()
    {
        return $this->belongsToMany('App\Models\Sport', 'results', 'country_id', 'sport_id')->withPivot('medal');
    }
}
