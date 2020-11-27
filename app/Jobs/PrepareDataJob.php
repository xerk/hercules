<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PrepareDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $clients;
    private string $file;
    private int $id = 0;
    private $time = 10;

    public function __construct($clients)
    {
        $this->file = "/exports/extract-data-" . Str::random(6) . '.csv';

        $this->clients = $clients;
    }

    public function handle()
    {
        while ($this->id < DB::table('clients')->count()) {
            ExportDataJob::dispatch($this->clients, $this->file, $this->id)->delay($this->time);
            $this->time +=100;
            $this->id +=100;
        }
    }
}
