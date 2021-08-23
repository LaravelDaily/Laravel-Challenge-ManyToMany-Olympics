<?php

namespace Database\Seeders;

use App\Models\Medal;
use Illuminate\Database\Seeder;

class MedalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medals = [
            [
                'name' => 'Gold'
            ],
            [
                'name' => 'Silver'
            ],
            [
                'name' => 'Bronze'
            ]
        ];

        Medal::insert($medals);
    }
}
