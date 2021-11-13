<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Jobs\SyncJob;
use App\Models\ActionJob;
use Illuminate\Http\Request;
use App\Models\Query\QueryWork;
use App\Models\Query\QueryHometown;
use App\Models\Query\QueryLocation;
use App\Models\Query\QueryPosition;
use App\Models\Query\QueryEducation;

class SyncDataController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $actionJobs = ActionJob::latest()->paginate(15);
        return Inertia::render('Dashboard/SyncData/Show', [
            'jobs' => $actionJobs,   
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $tables = [
            0 => ['class' => QueryWork::class, 'field' => 'work'],
            1 => ['class' => QueryPosition::class, 'field' => 'position'],
            2 => ['class' => QueryHometown::class, 'field' => 'hometown'],
            3 => ['class' => QueryLocation::class, 'field' => 'location'],
            4 => ['class' => QueryEducation::class, 'field' => 'education']
        ];
        foreach ($tables as $table) {
            $actionJob = ActionJob::create([
                'user_id' => auth()->user()->id,
                'name' => 'Sync <b>' . $table['field'] . '</b> from clients to be added in Query <b>' . $table['field'] . '</b> table.',
                'status' => 'processing',
            ]);

            SyncJob::dispatch($table, $actionJob);
        }

        return Inertia::render('Dashboard/SyncData/Show', [
            'jobs' => ActionJob::latest()->paginate(15),
            'message' => 'This action may take few minutes keep waiting, Thanks! ⌛'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
