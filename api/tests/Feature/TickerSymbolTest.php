<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\TickerSymbol;
use Tests\TestCase;

class TickerSymbolTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_ticker_symbols()
    {
        $response = $this->get('/api/tickersymbol');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name']
        ]);
    }

    public function test_get_one_ticker_symbol()
    {
        $tickerSymbol = TickerSymbol::factory()->create();

        $response = $this->get('/api/tickersymbol/'.
            $tickerSymbol->id
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name']);
    }

    public function test_get_unexisting_ticker_symbol()
    {
        $tickerSymbol = TickerSymbol::factory()->create();

        $response = $this->get('/api/tickersymbol/'.
            ++$tickerSymbol->id
        );

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Resource not found.'
        ]);
    }
}
