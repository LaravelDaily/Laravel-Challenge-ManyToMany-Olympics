<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relations.
     * 
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'rankings')
            ->as('rankings')
            ->withPivot('rank');
    }
}
