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
        return $this->belongsToMany(Country::class)
            ->withPivot(['position'])
            ->withTimestamps();
    }
    public function first()
    {
        return $this->belongsToMany(Country::class)
            ->withPivot(['position'])
            ->where('position', 1);
    }
    public function second()
    {
        return $this->belongsToMany(Country::class)
            ->withPivot(['position'])
            ->where('position', 2);
    }
    public function third()
    {
        return $this->belongsToMany(Country::class)
            ->withPivot(['position'])
            ->where('position', 3);
    }    
}
