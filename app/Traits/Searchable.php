<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * 
 */
trait Searchable
{
    public function scopeSearch(Builder $query, String $content, ?array $listCoulumn = null): Builder
    {
        if (collect($this->searchCoulumn)->isEmpty() && collect($listCoulumn)->isEmpty()) {
            return $query->where('id', $content);
        }

        foreach (collect($this->searchCoulumn)->merge($listCoulumn) as $find) {
            $query->orWhere($find, 'LIKE', '%' . $content . '%');
        }

        return $query;
    }
}
