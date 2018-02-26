<?php

namespace App\Http\ViewComposers;

use App\User;
use App\Client;
use App\Office;
use Illuminate\View\View;

class UserFiltersComposer
{
    /**
     * The clients.
     *
     * @var array
     */
    protected $clients;

    /**
     * The offices.
     *
     * @var array
     */
    protected $offices;

    /**
     * The positions.
     *
     * @var array
     */
    protected $positions;

    /**
     * Create a new users composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->clients = Client::pluck('name')->sort();
        $this->offices = Office::pluck('city')->sort();
        $this->positions = User::pluck('position')->unique()->sort();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'clients' => $this->clients,
            'offices' => $this->offices,
            'positions' => $this->positions,
        ]);
    }
}
