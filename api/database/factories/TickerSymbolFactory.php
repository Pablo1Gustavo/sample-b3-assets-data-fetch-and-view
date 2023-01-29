<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TickerSymbolFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->regexify('[A-Z]{4}[0-9]{2}')
        ];
    }
}
