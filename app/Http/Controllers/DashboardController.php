<?php

namespace App\Http\Controllers;

use App\Http\Responses\Dashboard;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'accept']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \App\Http\Responses\Dashboard;
     */
    public function index()
    {
        return new Dashboard;
    }
}
