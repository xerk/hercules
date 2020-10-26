<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    protected $clients;
    protected $user_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($clients, $path, $user_id)
    {
        $this->clients = $clients;
        $this->path = $path;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Export::create([
            'user_id' => $this->user_id,
            'name' => 'Extract Data',
            'file' => $this->path,
            'count' => $this->clients,
        ]);
    }
}
