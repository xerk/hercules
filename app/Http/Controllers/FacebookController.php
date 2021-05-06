<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\FacebookExport;
use App\Jobs\FacebookJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class FacebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $clientUser = DB::table('client_user')->where('user_id', $user->id)->select('group')->whereCount('clients')->orderBy('id', 'decs')->distinct('group')->paginate(15);
        return Inertia::render('Dashboard/Facebook/Show', [
            // 'test' => $user->clients->groupBy('pivot.group'),
            'results' => $clientUser,
            'clients' => [],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($key)
    {
        $user = User::find(Auth::id());
        $clients = Client::whereHas('users', function($q) use ($key) {
            $q->where('group', $key);
        })->paginate(15);
        return Inertia::render('Dashboard/Facebook/FacebookData', [
            // 'result' => $user->clients->where('pivot.group', $key)->paginate(15),
            'result' => $clients,
        ]);
    }

    public function download($token) {
        $user = User::find(Auth::id());
        $clients = $user->clients->where('pivot.group', $token);
        
        // $file = Export::where('id', $id)->where('user_id', Auth::id())->firstOrFail()->file;
        return Excel::download(new FacebookExport($clients), 'clients.csv');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        // dd($request->existEmail);
        $client = Client::select('name', 'gender', 'id')->doesntHave('users')->filter($request)->limit(10)->get();

        return Inertia::render('Dashboard/Facebook/Show', [
            'clients' => $client
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
        
        // $client = Client::doesntHave('users')->filter($request)->limit($request->count)->get();
        $user = User::find(Auth::id());
        // $user->clients()->attach($client->pluck('id'), ['group' => Str::random(12)]);
        FacebookJob::dispatch($request, $user)->afterResponse();
        
        return Redirect::route('facebook.find');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
