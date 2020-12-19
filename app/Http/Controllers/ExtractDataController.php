<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Export;
use App\Jobs\ExportJob;
use App\Mail\DataExported;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use App\Jobs\PrepareDataJob;
use Illuminate\Http\Request;
use App\Exports\ClientsExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ExtractDataController extends Controller
{
    private $result = [];
    private $file = '';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $export = Export::where('user_id', auth()->user()->id);
        return Inertia::render('Dashboard/Clients/Show', [
            'clients' => $export->latest()->paginate(15),
            'status' => $export->where('status', 'processing')->count(),
        ]);
    }

    private function endcode($ids)
    {
        $trimIds = trim($ids);
        $arrayOfIds = preg_split('/\r\n|\r|\n/', $trimIds);
        return array_filter($arrayOfIds, 'trim');
    }

    public function export(Request $request) 
    {
        Validator::make($request->all(), [
            'text' => ['required', 'mimetypes:text/plain'],
        ])->validateWithBag('filter');
        
        if ($request->hasFile('text')) {
            $fileContent = file_get_contents($request->text);
            $clients = $this->endcode($fileContent);
            
            $result = Client::whereIn('unique_id', $clients)->count();
            if ((auth()->user()->point - $result) <= -1) {
                return back()->withErrors([
                    'message' => 'You not have enough points.',
                ]);
            }

            if ($result > 0) {
                $path = "/exports/extract-data-" . Str::random(6) . '.csv';
                Excel::queue(new UsersExport($clients, $path), $path)->chain([
                    new ExportJob($result, $path, auth()->user()->id),
                ]);
                User::find(auth()->user()->id)->decrement('point', $result);
            } else {
                return back()->withErrors([
                    'message' => 'Not found data',
                ]);
            }


            return Inertia::render('Dashboard/Clients/Show', [
                'clients' => Export::where('user_id', auth()->user()->id)->latest()->paginate(10),
            ]);
        } 

    }

    public function export2(Request $request) 
    {
        Validator::make($request->all(), [
            'text' => ['required', 'mimetypes:text/plain'],
        ])->validateWithBag('filter');

        $fileContent = file_get_contents($request->text);
        $clients = $this->endcode($fileContent);
        $this->file = "/exports/extract-data-" . Str::random(6) . '.csv';

        $exportTable = Export::create([
            'user_id' => auth()->user()->id,
            'name' => 'Extract Data - '. Carbon::now()->toDateTimeString(),
            'count' => count($clients),
            'status' => 'processing',
        ]);

        PrepareDataJob::dispatch($clients, $request->user(), $exportTable)->afterResponse();


        return Inertia::render('Dashboard/Clients/Show', [
            'clients' => Export::where('user_id', auth()->user()->id)->latest()->paginate(10),
            'status' => Export::where('user_id', auth()->user()->id)->where('status', 'processing')->count(),
        ]);
    }

    public function download($id) {
        $file = Export::where('id', $id)->where('user_id', Auth::id())->firstOrFail()->file;
        return Storage::download($file);
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
    public function store(Request $request)
    {
        //
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
