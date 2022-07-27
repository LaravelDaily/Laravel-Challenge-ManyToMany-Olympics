<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'short_code'];

  public function sports(): BelongsToMany
  {
    return $this->belongsToMany(Sport::class)
      ->withPivot('medal');
  }

  public function scopeByMedal($query, string $medal)
  {
    return $query->whereHas('sports', function ($q) use ($medal) {
      $q->where('medal', $medal);
    });
  }

  public function scopeMostRewarded($query, $limit = 5)
  {
    return DB::table('countries as c')
        ->join('country_sport as cs', 'c.id', 'cs.country_id')
        ->join('sports as s', 's.id', 'cs.sport_id')
        ->select(DB::raw("
          c.name,
          sum(CASE WHEN medal LIKE 'gold' THEN 1 ELSE 0 END) as gold,
          sum(CASE WHEN medal LIKE 'silver' THEN 1 ELSE 0 END) as silver,
          sum(CASE WHEN medal LIKE 'bronze' THEN 1 ELSE 0 END) as bronze"))
        ->groupBy('c.name')
        ->orderByRaw('gold DESC, silver DESC, bronze DESC')
        ->limit($limit);
  }
}
