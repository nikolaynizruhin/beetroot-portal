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
        $user->update($request->prepared());

        $user->tags()->sync($request->tags());

        return back()->with('status', 'The beetroot was successfully updated!');
    }
}
