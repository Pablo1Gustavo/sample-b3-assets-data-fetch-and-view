<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\LendingOpenPosition;
use Tests\TestCase;

class LendingOpenPositionTest extends TestCase
{
    use DatabaseTransactions;

    function test_get_lending_open_postions()
    {
        $response = $this->get('/api/lendingopenposition');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['date', 'ticker_symbol_id', 'balance_amount', 'average_price','total_balance']
        ]);
    }

    function test_get_one_lending_open_position()
    {
        $lendingOpenPosition = LendingOpenPosition::factory()->create();

        $response = $this->get('/api/lendingopenposition/'
            .$lendingOpenPosition->id
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['date', 'ticker_symbol_id', 'balance_amount', 'average_price','total_balance']);
    }

    function test_get_one_unexisting_open_position()
    {
        $lendingOpenPosition = LendingOpenPosition::factory()->create();

        $response = $this->get('/api/lendingopenposition'
            .++$lendingOpenPosition->id
        );

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Resource not found.'
        ]);
    }
}
