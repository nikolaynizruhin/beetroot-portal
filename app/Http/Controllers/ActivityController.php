<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Queries\ActivityFeedQuery;

class ActivityController extends Controller
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
     * Show the activities feed.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = app(ActivityFeedQuery::class)();

        return view('activities.index', compact('activities'));
    }

    /**
     * Remove the specified activity from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException | \Exception
     */
    public function destroy(Activity $activity)
    {
        $this->authorize('delete', $activity);

        $activity->delete();

        return redirect()->route('activities.index');
    }
}
