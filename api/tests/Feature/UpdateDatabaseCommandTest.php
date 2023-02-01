<?php
namespace Tests\Feature;

use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UpdateDatabaseCommandTest extends TestCase
{
    function test_dispatch_a_job_to_the_queue()
    {
        Queue::fake();

        Artisan::call('update:database 30');

        Queue::assertPushed(\App\Jobs\LendingOpenPositionsFetcher::class, 31);
    }
}
