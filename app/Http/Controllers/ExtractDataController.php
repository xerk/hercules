<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Export;
use App\Jobs\ExportJob;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ExtractDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Dashboard/Clients/Show', [
            'clients' => Export::where('user_id', auth()->user()->id)->latest()->paginate(10),
        ]);
    }

    private function endcode($ids)
    {
        $normal = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "+"];
        $encode   = ["h", "m", "e", "p", "#", "s", "%", "b", "o", "r", "$"];
        $trimIds = trim($ids);
        $newPhrase = str_replace($normal, $encode, $trimIds);
        $arrayOfIds = preg_split('/\r\n|\r|\n/', $newPhrase);
        return array_filter($arrayOfIds, 'trim');
    }

    public function export(Request $request) 
    {
        Validator::make($request->all(), [
            'photo' => ['required'],
        ])->validateWithBag('filter');
        
        if ($request->hasFile('photo')) {
            $fileContent = file_get_contents($request->photo);
            $clients = $this->endcode($fileContent);
        
            $result = Client::query()->whereIn('unique_id', $clients)->count();

            if ((auth()->user()->point - count($result)) <= -1) {
                return back()->withErrors([
                    'message' => 'You not have enough points.',
                ]);
            }

            if ($result > 0) {
                $path = "/exports/extract-data-" . Str::random(6) . '.csv';
                Excel::queue(new UsersExport($clients, $path), $path)->chain([
                    new ExportJob($clients, $path, auth()->user()->id),
                ]);
                User::find(auth()->user()->id)->decrement('point', $result);
            }


            return Inertia::render('Dashboard/Clients/Show', [
                'clients' => Export::where('user_id', auth()->user()->id)->latest()->paginate(10),
            ]);
        } 

    }

    public function export2(Request $request) 
    {
        

        $path= 'asd';
        $clients= [];

        return Excel::queue(new UsersExport($clients, $path), 'users.csv');


        return Inertia::render('Dashboard/Clients/Show', [
            'clients' => Export::where('user_id', auth()->user()->id)->latest()->paginate(10),
        ]);

    }

    public function download($id) {
        return Storage::download(Export::find($id)->file);
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
