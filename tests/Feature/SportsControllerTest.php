<?php

namespace Tests\Feature;

use App\Models\Sport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SportsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_medals()
    {
        $this->seed();
        
        $response = $this->post(
            route('store'),
            [
                "sports" => [1 => [1, 2, 3], 2 => [3, 2, 1]],
            ]
        );

        $response->assertRedirect(route('show'));

        $this->assertDatabaseHas(
            'medals',
            [
                'country_id' => 1,
                'sport_id' => 1,
                'gold' => 1,
                'silver' => 0,
                'bronze' => 0,
            ]
        );
        
        $this->assertDatabaseHas(
            'medals',
            [
                'country_id' => 2,
                'sport_id' => 1,
                'gold' => 0,
                'silver' => 1,
                'bronze' => 0,
            ]
        );
        
        $this->assertDatabaseHas(
            'medals',
            [
                'country_id' => 3,
                'sport_id' => 1,
                'gold' => 0,
                'silver' => 0,
                'bronze' => 1,
            ]
        );
        
        $this->assertDatabaseHas(
            'medals',
            [
                'country_id' => 3,
                'sport_id' => 2,
                'gold' => 1,
                'silver' => 0,
                'bronze' => 0,
            ]
        );
        
        $this->assertDatabaseHas(
            'medals',
            [
                'country_id' => 2,
                'sport_id' => 2,
                'gold' => 0,
                'silver' => 1,
                'bronze' => 0,
            ]
        );
        
        $this->assertDatabaseHas(
            'medals',
            [
                'country_id' => 1,
                'sport_id' => 2,
                'gold' => 0,
                'silver' => 0,
                'bronze' => 1,
            ]
        );
    }
}
