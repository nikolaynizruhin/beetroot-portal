<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    /**
     * Handle the user "saved" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function saved(User $user)
    {
        $user->optimizeAvatar();
    }

    /**
     * Handle the user "deleting" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        $user->deleteAvatar();
    }
}
