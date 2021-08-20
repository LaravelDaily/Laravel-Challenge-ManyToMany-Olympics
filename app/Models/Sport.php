<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at'];

    public function winners()
    {
        return $this->belongsToMany('App\Models\Country', 'results', 'sport_id', 'country_id')->withPivot('medal');
    }
}
