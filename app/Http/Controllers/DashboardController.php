<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Export;
use App\Models\License;
use App\Models\Tutorial;
use App\Models\ChangeLog;
use Illuminate\Http\Request;
use App\Models\TermsAndCondition;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $license = License::all();
        return Inertia::render('Dashboard', [
            'license' => $license,
            'terms' => TermsAndCondition::latest('created_at')->first(),
            'changeLogs' => ChangeLog::all(),
            'tutorials' => Tutorial::all(),
            'export_counts' => Export::where('user_id', auth()->user()->id)->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $file = License::where('id', $id)->firstOrFail()->file;
        return Storage::disk('public')->download($file);
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