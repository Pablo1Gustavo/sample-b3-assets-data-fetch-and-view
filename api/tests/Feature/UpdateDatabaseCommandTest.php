<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UpdateDatabaseCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_database_command()
    {
        Artisan::call("update:database 3");

        $this->assertDatabaseHas('ticker_symbols', ['id' => 1]);
        $this->assertDatabaseHas('lending_open_positions', ['id' => 1]);
    }
}
