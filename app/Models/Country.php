<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];

    public function medals()
    {
        return $this->hasMany(Medal::class);
    }

    public function goldCount()
    {
        return $this->medals()->where('ranking', 1)->count();
    }

    public function silverCount()
    {
        return $this->medals()->where('ranking', 2)->count();
    }

    public function bronzeCount()
    {
        return $this->medals()->where('ranking', 3)->count();
    }
}
