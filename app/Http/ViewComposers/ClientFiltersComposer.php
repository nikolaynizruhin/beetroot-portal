<?php

namespace App\Http\ViewComposers;

use App\Client;
use Illuminate\View\View;

class ClientFiltersComposer
{
    /**
     * The countries.
     *
     * @var array
     */
    protected $countries;

    /**
     * Create a new users composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->countries = Client::countries();
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
            'countries' => $this->countries,
        ]);
    }
}
