<?php

namespace App\Policies;

use App\User;
use App\Office;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfficePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin user have all the permissions.
     *
     * @param  \App\User  $user
     * @param  $ability
     * @return mixed
     */
    public function before($user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the office.
     *
     * @param  \App\User  $user
     * @param  \App\Office  $office
     * @return mixed
     */
    public function view(User $user, Office $office)
    {
        //
    }

    /**
     * Determine whether the user can create offices.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the office.
     *
     * @param  \App\User  $user
     * @param  \App\Office  $office
     * @return mixed
     */
    public function update(User $user, Office $office)
    {
        //
    }

    /**
     * Determine whether the user can delete the office.
     *
     * @param  \App\User  $user
     * @param  \App\Office  $office
     * @return mixed
     */
    public function delete(User $user, Office $office)
    {
        //
    }
}
