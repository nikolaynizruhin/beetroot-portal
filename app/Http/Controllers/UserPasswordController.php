<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserPassword;
use App\User;

class UserPasswordController extends Controller
{
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

        return back()->with('status', 'The user password was successfully updated!');
    }
}
