<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Export;
use App\Mail\DataExported;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    protected $clients;
    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($clients, $path, $user)
    {
        $this->clients = $clients;
        $this->path = $path;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Export::create([
            'user_id' => $this->user->id,
            'name' => 'Extract Data - '. Carbon::now()->toDateTimeString(),
            'file' => $this->path,
            'count' => count($this->clients),
        ]);

        User::find($this->user->id)->decrement('point', count($this->clients));
        

    }
}
