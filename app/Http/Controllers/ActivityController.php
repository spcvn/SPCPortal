<?php

namespace SPCVN\Http\Controllers;

use SPCVN\Repositories\Activity\ActivityRepository;
use SPCVN\Repositories\Activity\EloquentActivity;
use SPCVN\User;
use Illuminate\Http\Request;

/**
 * Class ActivityController
 * @package SPCVN\Http\Controllers
 */
class ActivityController extends Controller
{
    /**
     * @var EloquentActivity1c\
     */

    private $activities;

    /**
     * ActivityController constructor.
     * @param ActivityRepository $activities
     */
    public function __construct(ActivityRepository $activities)
    {
        $this->middleware('auth');
        $this->middleware('permission:users.activity');
        $this->activities = $activities;
    }

    /**
     * Displays the page with activities for all system users.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = 20;
        $adminView = true;

        $activities = $this->activities->paginateActivities($perPage, $request->get('search'));

        return view('activity.index', compact('activities', 'adminView'));
    }

    /**
     * Displays the activity log page for specific user.
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userActivity(User $user, Request $request)
    {
        $perPage = 20;
        $adminView = true;

        $activities = $this->activities->paginateActivitiesForUser(
            $user->id, $perPage, $request->get('search')
        );

        return view('activity.index', compact('activities', 'user', 'adminView'));
    }
}
