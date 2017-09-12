<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $signedInUser
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $signedInUser, User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $signedInUser
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $signedInUser, User $user)
    {
        return $signedInUser->id === $user->id;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $signedInUser
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $signedInUser, User $user)
    {
        return false;
    }
}
