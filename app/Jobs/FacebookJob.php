<?php

namespace App\Jobs;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class FacebookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // protected $clients;
    protected $user;
    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = Client::doesntHave('users')->filter($this->request)->limit($this->request->count)->get();

        $order = 0;
        $maxOrder = DB::table('client_user')->max('order')->first();
        if ($maxOrder) {
            $order = $maxOrder++;
        }
        $this->user->clients()->attach($client->pluck('id'), ['group' => 'Facebook-Search-' . Str::random(12), 'status' => 'Completed', 'count' => count($client), 'order' => $order]);
    }
}
