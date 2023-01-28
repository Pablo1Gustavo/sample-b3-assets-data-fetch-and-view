<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\TickerSymbol::factory(20)->create();
        \App\Models\LendingOpenPosition::factory(40)->create();
    }
}
