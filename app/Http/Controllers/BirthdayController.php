<?php

namespace App\Http\Controllers;

use App\Queries\BirthdaysQuery;
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
        $this->middleware(['auth', 'accept']);
    }

    /**
     * Show the birthday list.
     *
     * @param  BirthdayFilters  $filters
     * @return \Illuminate\Http\Response
     */
    public function index(BirthdayFilters $filters)
    {
        $months = app(BirthdaysQuery::class)($filters);

        return view('birthdays.index')->with('months', $months);
    }
}
