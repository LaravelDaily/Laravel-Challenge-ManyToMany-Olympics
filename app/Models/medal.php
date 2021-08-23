<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medal extends Model
{
    use HasFactory;

    const GOLD = 1;
    const SILVER = 2;
    const BRONZE = 3;
}
