<?php

namespace Tests\Feature;

use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TravelsListTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_travels_list_returns_pagination(): void
    {

        Travel::factory(16)->create(['is_public' => true]);

        $response = $this->get('/api/v1/travels');

        $response->assertStatus(200);

        // We check if data returns 15 records and not 16
        $response->assertJsonCount(15, 'data');

        // We also check there are 2 pages in total
        $response->assertJsonPath('meta.last_page', 2);
    }
}
