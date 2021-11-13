<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Export;
use App\Jobs\ExportJob;
use App\Models\PointLog;
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
}
