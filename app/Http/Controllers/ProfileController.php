<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UpdateProfile;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'accept']);
    }

    /**
     * Update the own user profile.
     *
     * @param  \App\Http\Requests\UpdateProfile  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfile $request, User $user)
    {
        $user->update($request->validated());

        return back()->with('status', 'The employee was successfully updated!');
    }
}
