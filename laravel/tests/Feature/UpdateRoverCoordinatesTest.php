<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route;
use Tests\TestCase;

class UpdateRoverCoordinatesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $data = [
            "id" => 1,
            "planet_id" =>  1,
            "instructions" => "FFRRFFFRL"
        ];

        $response = $this->post(route('rover.send-instructions'), $data);

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_failed_response()
    {
        $data = [
            "id" => 0,
            "planet_id" =>  1,
            "instructions" => "FFRRFFFRL"
        ];

        $response = $this->post(route('rover.send-instructions'), $data);

        $response->assertStatus(404);
    }
}
