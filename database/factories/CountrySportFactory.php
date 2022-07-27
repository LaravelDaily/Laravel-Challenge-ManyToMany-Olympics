<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\CountrySport;
use App\Models\Sport;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountrySportFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = CountrySport::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $medals = [
      CountrySport::GOLD_MEDAL,
      CountrySport::SILVER_MEDAL,
      CountrySport::BRONZE_MEDAL,
    ];

    return [
      'medal' => $this->faker->randomElement($medals),
      'country_id' => Country::inRandomOrder()->first()->id,
      'sport_id' => Sport::inRandomOrder()->first()->id,
    ];
  }
}
