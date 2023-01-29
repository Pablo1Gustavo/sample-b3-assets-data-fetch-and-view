<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LendingOpenPositionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'isin' => fake()->regexify('[A-Z]{9}[0-9]{3}'),
            'date' => fake()->dateTimeBetween('-2 months', '-2 days')->format('Y-m-d'),
            'ticker_symbol_id' => \App\Models\TickerSymbol::inRandomOrder()->first()->id,
            'balance_amount' => fake()->numberBetween(1, 10**8),
            'average_price' => fake()->randomFloat(6, 1, 10000),
            'total_balance' => fake()->randomFloat(2, 1, 10**9),
        ];
    }
}
