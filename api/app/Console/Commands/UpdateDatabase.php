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

        $bar = $this->output->createProgressBar($daysInterval + 1);

        $bar->start();

        $job = new \App\Jobs\LendingOpenPositionsFetcher('');

        for ($day = 0; $day <= $daysInterval; $day++)
        {
            $job->setDate(date('Y-m-d', strtotime("-".$day." days")));
            $job->handle();

            $bar->advance();
        }

        $bar->finish();

        return Command::SUCCESS;
    }
}
