<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateDatabase extends Command
{
    protected $signature = 'update:database {days=0}';

    protected $description = 'Add non-existent lending_open_positions and update ticker_symbols from a number of days ago';

    public function handle()
    {
        $daysInterval = intval($this->argument('days'));

        $this->info('Queueing fetcher jobs for '.($daysInterval + 1).' days...');

        for ($day = 0; $day <= $daysInterval; $day++)
        {
            $date = date('Y-m-d', strtotime("-$day days"));

            dispatch(new \App\Jobs\LendingOpenPositionsFetcher($date));
        }

        $this->info('Fetcher jobs queued successfully.');

        return Command::SUCCESS;
    }
}
