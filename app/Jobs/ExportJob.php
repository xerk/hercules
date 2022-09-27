<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Export;
use App\Models\PointLog;
use App\Mail\DataExported;
use Illuminate\Bus\Queueable;
use App\Notifications\FileGenerate;
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
    protected $export;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($clients, $path, $user, $export)
    {
        $this->clients = $clients;
        $this->path = $path;
        $this->user = $user;
        $this->export = $export;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Export::where('id', $this->export->id)->update([
            'file' => $this->path,
            'result' => count($this->clients),
            'status' => 'completed',
        ]);

        User::find($this->user->id)->decrement('point', count($this->clients)); 
        $pointLog = PointLog::create([
            'log' => 'Points have been deducted from your account for export data',
            'point' => '-' . count($this->clients),
            'user_id' => auth()->user()->id,
            'status' => 'succeed',
        ]);

        $this->user->notify(new FileGenerate(count($this->clients)));

    }
}
