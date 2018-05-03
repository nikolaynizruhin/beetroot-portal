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
            ->filter($filters)
            ->get()
            ->sortBy('month_of_birth')
            ->groupBy('name_of_month_of_birth');

        return view('birthdays.index')->with('months', $months);
    }
}
