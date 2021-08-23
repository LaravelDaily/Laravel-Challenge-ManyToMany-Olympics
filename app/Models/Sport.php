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
        return $this->belongsToMany(Country::class)->withPivot('position');
    }
}
