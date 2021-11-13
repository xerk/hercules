<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $table;
    protected $actionJob;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($table, $actionJob)
    {
        $this->table = $table;
        $this->actionJob = $actionJob;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $clients = DB::table('clients')->select($this->table['field'] . ' AS name', DB::raw('count('. $this->table['field'] .') as count'))->where($this->table['field'], '<>', '')->groupBy($this->table['field'])->get();

        foreach($clients as $client) {
            $clientArr = json_decode(json_encode($client), true);

            $this->table['class']::updateOrCreate($clientArr, $clientArr);
        }

        $this->actionJob->status = 'finished';   
        $this->actionJob->save();
    }
}
