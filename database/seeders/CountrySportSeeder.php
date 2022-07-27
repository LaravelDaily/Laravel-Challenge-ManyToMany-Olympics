<?php

namespace Database\Seeders;

use App\Models\CountrySport;
use App\Models\Sport;
use Illuminate\Database\Seeder;

class CountrySportSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $sports = Sport::all();

    foreach ($sports as $sport) {
      CountrySport::factory()
        ->count(3)
        ->sequence(
          ['medal' => CountrySport::GOLD_MEDAL],
          ['medal' => CountrySport::SILVER_MEDAL],
          ['medal' => CountrySport::BRONZE_MEDAL])
        ->create(['sport_id' => $sport->id]);
    }
  }
}
