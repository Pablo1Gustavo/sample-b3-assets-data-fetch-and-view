<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateDatabase extends Command
{
    protected $signature = 'update:database {days=30}';

    protected $description = 'Update the ticker_symbols table and add unexisting lending_open_positions';

    public function handle()
    {
        $daysInterval = intval($this->argument('days'));

        $bar = $this->output->createProgressBar($daysInterval);

        $bar->start();

        $job = new \App\Jobs\LendingOpenPositionsFetcher(date('Y-m-d'));

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
