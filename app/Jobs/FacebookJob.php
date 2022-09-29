<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\PointLog;
use App\Models\DataGroup;
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
    protected $dataGroup;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $user, DataGroup $dataGroup)
    {
        $this->request = $request;
        $this->user = $user;
        $this->dataGroup = $dataGroup;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $client = Client::select('id')->whereDoesntHave('users', function($q) {
            $q->where('user_id', $this->user->id);
        })->filter($this->request)->limit($this->request['count'])->get();

        $order = 1;
        $maxOrder = DB::table('client_user')->orderBy('order', 'desc')->first();

        if ($maxOrder) {
            $order = $maxOrder->order + 1;
        }

        $this->dataGroup->update(['status' => 'Processing', 'count' => count($client)]);
        
        $chunk = 1000;
        if ($this->request['count'] >= 100000) {
            $chunk = $this->request['count'] * 0.01;
        }
        if ($chunk <= 5000) {
            $chunk = 5000;
        }

        $clients = collect(array_chunk($client->toArray(), $chunk));

        foreach($clients as $item) {
            $collection = collect($item);

            $this->user->clients()->attach($collection->pluck('id'), [
                    'data_group_id' => $this->dataGroup->id, 
                    'group' => 'Facebook-Search-' . Str::random(12), 
                    'status' => 'Completed', 
                    'count' => count($client), 
                    'order' => $order
                ]);
        }
        
        User::find($this->user->id)->decrement('point', (count($client) * 2));


        $pointLog = PointLog::create([
            'log' => 'Points have been deducted from your account for facebook information',
            'point' => '-' . (count($client) * 2),
            'user_id' => $this->user->id,
            'status' => 'succeed',
        ]);

        $this->dataGroup->update(['status' => 'Completed', 'count' => count($client)]);       

    }
}
