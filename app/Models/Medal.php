<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Medal extends Pivot
{
    protected $table = 'medals';

    // pivot table madel column names ordered by prioritize
    const NAMES = [
        "gold",
        "silver",
        "bronze",
    ];
}
