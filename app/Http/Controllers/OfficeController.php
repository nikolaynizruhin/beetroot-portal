<?php

namespace App\Http\Controllers;

use App\Office;
use App\Queries\OfficesQuery;
use App\Http\Requests\StoreOffice;
use App\Http\Requests\UpdateOffice;

class OfficeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = app(OfficesQuery::class)();

        return view('offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new office.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Office::class);

        return view('offices.create', ['office' => new Office]);
    }

    /**
     * Store a newly created office in storage.
     *
     * @param  \App\Http\Requests\StoreOffice  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOffice $request)
    {
        Office::create($request->validated());

        return back()->with('status', 'The location was successfully created!');
    }

    /**
     * Show the form for editing the specified office.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Office $office)
    {
        $this->authorize('edit', $office);

        return view('offices.edit', compact('office'));
    }

    /**
     * Update the specified office in storage.
     *
     * @param  \App\Http\Requests\UpdateOffice  $request
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOffice $request, Office $office)
    {
        $office->update($request->validated());

        return back()->with('status', 'The location was successfully updated!');
    }

    /**
     * Remove the specified office from storage.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException | \Exception
     */
    public function destroy(Office $office)
    {
        $this->authorize('delete', $office);

        $office->delete();

        return redirect()
            ->route('offices.create')
            ->with('status', 'The location was successfully deleted!');
    }
}
