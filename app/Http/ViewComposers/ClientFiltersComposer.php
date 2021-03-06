<?php

namespace App\Http\ViewComposers;

use App\Tag;
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
     * The sorts.
     *
     * @var array
     */
    protected $sorts;

    /**
     * The tags.
     *
     * @var array
     */
    protected $tags;

    /**
     * Create a new users composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->countries = Client::countries();
        $this->sorts = Client::sorts();
        $this->tags = Tag::all();
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
            'tags' => $this->tags,
            'sorts' => $this->sorts,
        ]);
    }
}
