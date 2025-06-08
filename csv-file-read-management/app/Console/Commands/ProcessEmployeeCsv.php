<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessEmployeeCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:employee-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new \App\Jobs\ProcessEmployeeCSV());
    }
}
