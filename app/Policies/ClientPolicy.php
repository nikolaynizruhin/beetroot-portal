<?php

namespace App\Policies;

use App\User;
use App\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create clients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view edit client page.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function edit(User $user, Client $client)
    {
        return false;
    }

    /**
     * Determine whether the user can update the client.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function update(User $user, Client $client)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the client.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function delete(User $user, Client $client)
    {
        return false;
    }
}
