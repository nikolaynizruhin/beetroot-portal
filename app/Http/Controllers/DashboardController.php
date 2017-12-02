<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Office;
use App\Queries\ClientCountQuery;
use App\Queries\PositionCountQuery;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param  \App\Queries\ClientCountQuery  $clients
     * @param  \App\Queries\PositionCountQuery  $positions
     * @return \Illuminate\Http\Response
     */
    public function index(ClientCountQuery $clients, PositionCountQuery $positions)
    {
        return view('dashboard')->with([
            'userCount' => User::count(),
            'clientCount' => Client::count(),
            'officeCount' => Office::count(),
            'positions' => $positions(),
            'clients' => $clients(),
        ]);
    }
}
