<?php

namespace App\Http\Responses;

use App\User;
use App\Client;
use App\Office;
use App\Queries\ClientCountQuery;
use App\Queries\PositionCountQuery;
use App\Queries\OfficeEmployeeCountQuery;
use Illuminate\Contracts\Support\Responsable;

class Dashboard implements Responsable
{
    /**
     * Get user count.
     *
     * @return int
     */
    public function userCount()
    {
        return User::count();
    }

    /**
     * Get client count.
     *
     * @return int
     */
    public function clientCount()
    {
        return Client::count();
    }

    /**
     * Get office count.
     *
     * @return int
     */
    public function officeCount()
    {
        return Office::count();
    }

    /**
     * Get position count collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function positions()
    {
        return resolve(PositionCountQuery::class)();
    }

    /**
     * Get client count collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function clients()
    {
        return resolve(ClientCountQuery::class)();
    }

    /**
     * Get office employee count collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function offices()
    {
        return resolve(OfficeEmployeeCountQuery::class)();
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return view('dashboard')->with([
            'userCount' => $this->userCount(),
            'clientCount' => $this->clientCount(),
            'officeCount' => $this->officeCount(),
            'positions' => $this->positions(),
            'clients' => $this->clients(),
            'offices' => $this->offices(),
        ]);
    }
}
