<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCount = User::count();
        $clientCount = Client::count();
        $officeCount = Office::count();

        $positions = DB::table('users')
                ->select('position', DB::raw('COUNT(*) as count'))
                ->groupBy('position')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get();

        $clients = DB::table('clients')
                ->select('country', DB::raw('COUNT(*) as count'))
                ->groupBy('country')
                ->orderBy('count', 'desc')
                ->get();

        return view('home')->with([
            'userCount' => $userCount,
            'clientCount' => $clientCount,
            'officeCount' => $officeCount,
            'positions' => $positions,
            'clients' => $clients,
        ]);
    }
}
