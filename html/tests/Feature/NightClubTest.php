<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\Ref;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NightClubTest extends TestCase
{
    /**
     * Test setting the number of people in the nightclub via API.
     *
     * @return void
     */


    public function testSetPeopleCount()
    {
        $response = $this->postJson('/nightclub/set-people-count', ['count' => 10]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Nightclub party started with 10 people!'
            ]);
    }

}

