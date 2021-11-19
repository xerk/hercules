<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = [];
        if ($request->has('username')) {
            $search = Client::search($request)->get();
        }
        return Inertia::render('Dashboard/SearchUser/Show', [
            'search' => $search, 
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $search = Client::search($request)->get();
        return Inertia::render('Dashboard/SearchUser/Show', [
            'search' => $search, 
        ]);
    }
}
