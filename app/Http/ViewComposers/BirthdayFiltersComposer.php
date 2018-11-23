<?php

namespace App\Http\ViewComposers;

use App\Office;
use Illuminate\View\View;

class BirthdayFiltersComposer
{
    /**
     * The offices.
     *
     * @var array
     */
    protected $offices;

    /**
     * Create a new users composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->offices = Office::cities();
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
            'offices' => $this->offices,
        ]);
    }
}
