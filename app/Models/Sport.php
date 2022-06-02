<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The countries that belong to the Sport
     *
     * @return BelongsToMany
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class)->withPivot(['type_score']);
    }
}
