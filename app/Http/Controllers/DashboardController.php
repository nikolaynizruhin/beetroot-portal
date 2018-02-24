<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Office;
use App\Queries\ClientCountQuery;
use App\Queries\PositionCountQuery;
use App\Queries\OfficeEmployeeCountQuery;

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
     * @param  \App\Queries\OfficeEmployeeCountQuery  $offices
     * @return \Illuminate\Http\Response
     */
    public function index(
        ClientCountQuery $clients,
        PositionCountQuery $positions,
        OfficeEmployeeCountQuery $offices
    ) {
        return view('dashboard')->with([
            'userCount' => User::count(),
            'clientCount' => Client::count(),
            'officeCount' => Office::count(),
            'positions' => $positions(),
            'clients' => $clients(),
            'offices' => $offices(),
        ]);
    }
}
