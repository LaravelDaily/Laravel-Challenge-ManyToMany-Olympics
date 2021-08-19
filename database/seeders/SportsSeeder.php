<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;

class SportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sports = [
            [
                'name' => 'Basketball'
            ],
            [
                'name' => 'Weightlifting'
            ],
            [
                'name' => 'Tennis'
            ],
            [
                'name' => 'Swimming'
            ],
            [
                'name' => 'Rowing'
            ]
        ];

        Sport::insert($sports);
    }
}
