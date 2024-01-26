<?php

namespace App\Console\Commands;

use App\Models\SaveTrace;
use Illuminate\Console\Command;

class SaveTraceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save_traces:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete table save_traces';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $saveTraces = SaveTrace::all();
        foreach ($saveTraces as $saveTrace) {
            $saveTrace->delete();
        }
    }
}
