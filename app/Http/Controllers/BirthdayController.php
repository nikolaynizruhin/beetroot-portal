<?php

namespace App\Http\Controllers;

use App\User;
use App\Filters\BirthdayFilters;

class BirthdayController extends Controller
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
     * Show the birthday list.
     *
     * @param  BirthdayFilters  $filters
     * @return \Illuminate\Http\Response
     */
    public function index(BirthdayFilters $filters)
    {
        $months = User::with(['client', 'office'])
            ->orderByBirthday()
            ->filter($filters)
            ->get()
            ->groupBy('month_of_birth');

        return view('birthdays.index')->with('months', $months);
    }
}
