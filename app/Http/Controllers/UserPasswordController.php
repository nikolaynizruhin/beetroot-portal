<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UpdateUserPassword;

class UserPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update user password.
     *
     * @param  \App\Http\Requests\UpdateUserPassword  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPassword $request, User $user)
    {
        $user->update(['password' => bcrypt($request->password)]);

        return back()->with('status', 'The employee password was successfully updated!');
    }
}
