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
        

        $client = Client::whereDoesntHave('users', function($q) {
            $q->where('user_id', $this->user->id);
        })->filter($this->request)->limit($this->request->count)->get();

        $order = 1;
        $maxOrder = DB::table('client_user')->orderBy('order', 'desc')->first();

        if ($maxOrder) {
            $order = $maxOrder->order + 1;
        }

        $dataGroup = DataGroup::create([
            'name' => 'Facebook-Search ' . Carbon::now()->toDateTimeString(),
            'user_id' => $this->user->id,
            'group' => Str::random(6),
            'status' => 'Pending',
            'count' => count($client)
        ]);

        $this->user->clients()->attach($client->pluck('id'), ['data_group_id' => $dataGroup->id, 'group' => 'Facebook-Search-' . Str::random(12), 'status' => 'Completed', 'count' => count($client), 'order' => $order]);

        User::find(auth()->user()->id)->decrement('point', (count($client) * 2));

        $dataGroup = DataGroup::create([
            'name' => 'Facebook-Search ' . Carbon::now()->toDateTimeString(),
            'user_id' => $this->user->id,
            'group' => Str::random(6),
            'status' => 'Completed',
            'count' => count($client)
        ]);

        $pointLog = PointLog::create([
            'log' => 'Points have been deducted from your account for facebook information',
            'point' => '-' . (count($client) * 2),
            'user_id' => auth()->user()->id,
            'status' => 'succeed',
        ]);

    }
}
