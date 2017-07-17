<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Client;
use App\Office;

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
     * Create a new users composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->clients = Client::pluck('name', 'id');
        $this->offices = Office::pluck('city', 'id');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(['clients' => $this->clients, 'offices' => $this->offices]);
    }
}
