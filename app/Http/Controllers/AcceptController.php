<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcceptController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'accepted']);
    }

    /**
     * Show the form for accept a privacy policy.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        return view('accept.create');
    }

    /**
     * Store a newly created accept in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['privacy' => 'accepted']);

        $request->user()->update(['accepted_at' => now()]);

        return redirect(route('dashboard'));
    }
}
