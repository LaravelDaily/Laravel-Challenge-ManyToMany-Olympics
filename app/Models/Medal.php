<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medal extends Model
{
    use HasFactory;

    CONST GOLD = 1,
        SLIVER = 2,
        BRONZE = 3;
}
