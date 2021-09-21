<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];
    public function gold_medals()
    {
        return $this->belongsToMany(Sport::class)
            ->withPivot(['position'])
            ->where('position', 1);
    }
    public function silver_medals()
    {
        return $this->belongsToMany(Sport::class)
            ->withPivot(['position'])
            ->where('position', 2);
    }
    public function bronze_medals()
    {
        return $this->belongsToMany(Sport::class)
            ->withPivot(['position'])
            ->where('position', 3);
    }
}
