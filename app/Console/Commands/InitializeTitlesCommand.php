<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\InitializeTitlesJob;

class InitializeTitlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'titles:initialize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize all titles';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        InitializeTitlesJob::dispatch();
    }
}
