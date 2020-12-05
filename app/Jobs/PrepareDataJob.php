<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Exports\ClientsExport;
use Illuminate\Support\Facades\DB;
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
    private $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($clients, $user_id)
    {
        $this->file = "/exports/extract-data-" . Str::random(6) . '.csv';

        $this->clients = $clients;

        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('clients')->orderBy('id')->select('unique_id', 'mobile', 'nationality')->whereIn('unique_id', $this->clients)->chunk(1000, function ($clients) {
            foreach ($clients as $client) {
                $this->result[] = $client;
            }
        });
        
        if ($this->result > 0) {
            Excel::store(new ClientsExport($this->result), $this->file);

            ExportJob::dispatch($this->result, $this->file, $this->user_id);

            User::find($this->user_id)->decrement('point', ($this->result));
        }
    }
}
