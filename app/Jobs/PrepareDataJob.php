<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\DataExported;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Exports\ClientsExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PrepareDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $clients;
    private $file;
    private $result = [];
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($clients, $user)
    {
        $this->file = "/exports/extract-data-" . Str::random(6) . '.csv';

        $this->clients = $clients;

        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('clients')->orderBy('id')->select('unique_id', 'mobile', 'nationality')->whereIn('unique_id', $this->clients)->chunk(10000, function ($clients) {
            foreach ($clients as $client) {
                $this->result[] = $client;
            }
        });

        $uniques = [];
        foreach ($this->result as $c) {
            $uniques[$c->unique_id] = $c; // Get unique country by code.
        }

        if (count($uniques) > 0) {
            Excel::store(new ClientsExport($uniques), $this->file);

            ExportJob::dispatch($uniques, $this->file, $this->user);

            dispatch(Mail::to($this->user)->queue(new DataExported()));

            

        
        }
    }
}
