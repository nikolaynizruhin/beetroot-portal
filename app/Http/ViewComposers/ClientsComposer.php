<?php

namespace App\Http\ViewComposers;

use App\Tag;
use Illuminate\View\View;

class ClientsComposer
{
    /**
     * The tags.
     *
     * @var array
     */
    protected $tags;

    /**
     * Create a new clients composer.
     *
     * @return void
     */
    public function __construct()
    {
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
        $view->with(['tags' => $this->tags]);
    }
}
