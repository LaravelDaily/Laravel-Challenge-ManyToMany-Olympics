<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CountrySport extends Pivot
{
    public const MEDAL_TO_STANDING = [
        'gold' => 'first',
        'silver' => 'second',
        'bronze' => 'third',
    ];

    public const STANDING_TO_MEDAL = [
        'first' => 'gold',
        'second' => 'silver',
        'third' => 'bronze',
    ];

    protected $increments = true;

    public $timestamps = true;
}
