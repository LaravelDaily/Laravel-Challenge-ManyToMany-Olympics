<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class)
            ->using(CountrySport::class)
            ->withPivot('medal')
            ->withTimestamps();
    }
}
