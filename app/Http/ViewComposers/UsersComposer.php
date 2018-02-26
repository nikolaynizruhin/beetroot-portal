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
        $this->clients = Client::pluck('name', 'id')->sort();
        $this->offices = Office::pluck('city', 'id')->sort();
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
