<?php

namespace App\Observers;

use App\Client;

class ClientObserver
{
    /**
     * Handle the client "saved" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function saved(Client $client)
    {
        $client->optimizeLogo();
    }

    /**
     * Handle the client "deleting" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function deleting(Client $client)
    {
        $client->deleteLogo();
    }
}
