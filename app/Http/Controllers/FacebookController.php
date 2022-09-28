<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Client;
use App\Jobs\FacebookJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\FacebookExport;
use App\Models\DataGroup;
use App\Models\Query\QueryWork;
use Illuminate\Support\Facades\DB;
use App\Models\Query\QueryHometown;
use App\Models\Query\QueryLocation;
use App\Models\Query\QueryPosition;
use App\Models\Query\QueryEducation;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request)
    {
        $autocomplete = [];
        if ($request->has('q')) {
            $collection = collect([
                ['class' => QueryWork::class, 'field' => 'work'],
                ['class' => QueryPosition::class, 'field' => 'position'],
                ['class' => QueryHometown::class, 'field' => 'hometown'],
                ['class' => QueryLocation::class, 'field' => 'location'],
                ['class' => QueryEducation::class, 'field' => 'education']
            ]);
            
            $query = $request->q;
    
            $filtered = $collection->firstWhere('field', $request->table);
    
            $autocomplete = $filtered['class']::select('name', 'count')->where('name', 'LIKE', '%' . $query . '%')->orderBy('count', 'DESC')->limit(20)->get();
        }

        $clientUser = DataGroup::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(15);
        return Inertia::render('Dashboard/Facebook/Show', [
            // 'test' => $user->clients->groupBy('pivot.group'),
            'results' => $clientUser,
            'clients' => [],
            'clientWithOut' => [],
            'autocomplete' => $autocomplete
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($id)
    {
        $dataGroup = DataGroup::find($id);
        if ($dataGroup->user_id == Auth::id()) {
            $clients = Client::whereHas('users', function($q) use ($dataGroup) {
                $q->where('data_group_id', $dataGroup->id);
            })->paginate(15);
            return Inertia::render('Dashboard/Facebook/FacebookData', [
                'result' => $clients,
            ]);
        }
    }

    public function download($id) {
        $user = User::find(Auth::id());
        $dataGroup = DataGroup::find($id);

        if ($dataGroup->user_id == $user->id) {
            $clients = $user->clients->where('pivot.data_group_id', $dataGroup->id);
            return Excel::download(new FacebookExport($clients), 'clients.csv');

        } else {
            return back()->withErrors([
                'message' => 'Not Authorize data.',
            ]);
        }   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        if ($request->count)
            $user = User::find(Auth::id());
            $client = Client::select('name', 'gender', 'id')->whereDoesntHave('users', function($q) use($user) {
                $q->where('user_id', $user->id);
            })->filter($request)->limit(10)->get();
            
            $clientCount = Client::select('id')->whereDoesntHave('users', function($q) use($user) {
                $q->where('user_id', $user->id);
            })->filter($request)->limit($request->count)->get()->count();

            $clientWithOut = Client::select('name', 'gender', 'id')->filter($request)->limit(10)->get();
            
            $clientCountWithOut = Client::select('id')->filter($request)->limit($request->count)->get()->count();

            $clientUser = DataGroup::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(15);

        return Inertia::render('Dashboard/Facebook/Show', [
            'clients' => $client,
            'clientCount' => $clientCount,
            'results' => $clientUser,
            'clientWithOut' => $clientWithOut,
            'clientCountWithOut' => $clientCountWithOut,
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

        $dataGroup = DataGroup::create([
            'name' => 'Facebook-Search ' . Carbon::now()->toDateTimeString(),
            'user_id' => $user->id,
            'group' => Str::random(6),
            'status' => 'Pending',
            'count' => 0,
        ]);

        // $user->clients()->attach($client->pluck('id'), ['group' => Str::random(12)]);
        FacebookJob::dispatch($request, $user, $dataGroup->id);
        
        return Redirect::route('facebook.find');
    }
}
