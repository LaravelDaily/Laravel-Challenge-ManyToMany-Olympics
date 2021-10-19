<?php

namespace Database\Seeders;

use App\Models\CountrySportMedal;
use Illuminate\Database\Seeder;

class CountrySportMedalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CountrySportMedal::factory()
            ->count(10000)
            ->create();
    }
}
