<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_code'];

    public function sports()
    {
        return $this->belongsToMany(Sport::class)->withPivot('position');
    }

    public function scopeWithCountGolds($query)
    {
        $query->withCount(['sports as golds_count' => function ($q) {
            $q->where('position', 1);
        }]);
    }

    public function scopeWithCountSilvers($query)
    {
        $query->withCount(['sports as silvers_count' => function ($q) {
            $q->where('position', 2);
        }]);
    }

    public function scopeWithCountBronzes($query)
    {
        $query->withCount(['sports as bronzes_count' => function ($q) {
            $q->where('position', 3);
        }]);
    }
}
