<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\CountrySportMedal;
use App\Models\Medal;
use App\Models\Sport;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountrySportMedalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CountrySportMedal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country_id' => $this->faker->numberBetween(1, Country::count()),
            'sport_id' =>$this->faker->numberBetween(1, Sport::count()),
            'medal_id' => $this->faker->numberBetween(1, Medal::count())
        ];
    }
}
