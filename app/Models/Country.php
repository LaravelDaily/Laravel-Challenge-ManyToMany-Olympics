<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];

    /**
     * Relations.
     * 
     */
    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'rankings')
            ->as('rankings')
            ->withPivot('rank');
    }

    public function gold()
    {
        return $this->belongsToMany(Sport::class, 'rankings')
            ->wherePivot('rank', 1);
    }

    public function silver()
    {
        return $this->belongsToMany(Sport::class, 'rankings')
            ->wherePivot('rank', 2);
    }

    public function bronze()
    {
        return $this->belongsToMany(Sport::class, 'rankings')
            ->wherePivot('rank', 3);
    }

    /**
     * Scopes.
     * 
     */
    public function scopeGetId(
        $query,
        string $column,
        string $expected
    ): int {
        return $query->where($column, $expected)->first('id')->id;
    }

    public function scopeCountMedals($query): Builder
    {
        return $query->withCount(['gold', 'bronze', 'silver']);
    }

    public function scopeOrderByMedal($query): Builder
    {
        return $query->orderByDesc('gold_count')
            ->orderByDesc('silver_count')
            ->orderByDesc('bronze_count');
    }
}
