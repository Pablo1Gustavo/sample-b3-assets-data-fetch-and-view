<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TickerSymbolFactory extends Factory
{
    public function definition()
    {
        return [
            'ticker_symbol' => fake()->regexify('[A-Z]{4}[0-9]{2}')
        ];
    }
}
