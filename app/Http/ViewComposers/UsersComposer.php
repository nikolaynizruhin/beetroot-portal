<?php

namespace App\Http\ViewComposers;

use App\Client;
use App\Office;
use Illuminate\View\View;
use App\Http\Utilities\Position;

class UsersComposer
{
    /**
     * The clients.
     *
     * @var Client
     */
    protected $clients;

    /**
     * The offices.
     *
     * @var Client
     */
    protected $offices;

    /**
     * The positions.
     *
     * @var Client
     */
    protected $positions;

    /**
     * Create a new users composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->clients = Client::pluck('name', 'id');
        $this->offices = Office::pluck('city', 'id');
        $this->positions = Position::all();
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
