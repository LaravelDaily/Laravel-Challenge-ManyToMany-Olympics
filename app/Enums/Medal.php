<?php

namespace App\Enums;

/*
 * Class with constants is used because of old PHP version.
 * From PHP v8.1 can use enum instead
*/
final class Medal
{
    const GOLD = 'gold';

    const SILVER = 'silver';

    const BRONZE = 'bronze';
}