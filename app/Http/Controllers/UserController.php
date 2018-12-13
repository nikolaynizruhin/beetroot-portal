<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Office;
use App\Queries\UsersQuery;
use App\Filters\UserFilters;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
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
     * Show the user list.
     *
     * @param  UserFilters  $filters
     * @return \Illuminate\Http\Response
     */
    public function index(UserFilters $filters)
    {
        $users = app(UsersQuery::class)($filters);

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \App\Http\Requests\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $user = User::create($request->prepared());

        $user->syncTags($request->tags());

        $user->sendWelcomeNotification($request->password);

        return back()->with('status', 'The beetroot was successfully created!');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Http\Requests\UpdateUser  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $user->update($request->prepared());

        $user->syncTags($request->tags());

        return back()->with('status', 'The beetroot was successfully updated!');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException | \Exception
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.create')->with('status', 'The beetroot was successfully deleted!');
    }
}
