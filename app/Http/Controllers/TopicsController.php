<?php

namespace SPCVN\Http\Controllers;


use SPCVN\Repositories\User\UserRepository;
use SPCVN\Repositories\Topic\TopicRepository;
use SPCVN\Repositories\Category\CategoryRepository;
use SPCVN\Http\Requests\Topic\CreateTopicRequest;
use SPCVN\Http\Requests\Topics\UpdateTopicRequest;
use SPCVN\Topic;
use SPCVN\User;
use Auth;
use Authy;
use Illuminate\Http\Request;

class TopicsController extends Controller
{

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var TopicRepository
     */
    private $topic;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     * @param TopicRepository $category
     */
    public function __construct(UserRepository $users, TopicRepository $topic)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->topic = $topic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $topics = $this->topic->paginate(30, $request->input('search'));
        return view('topic.list', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Topic $topic, CategoryRepository $categoryRepos)
    {
        $edit       = false;
        $users      = User::all()->pluck('full_name', 'id');
        $categories = $categoryRepos->makeCategoryMultiLevel();
        $user_login_id = Auth::id();

        return view('topic.create', compact('topic', 'categories', 'edit', 'users', 'user_login_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTopicRequest $request)
    {
        $topic = $this->topic->create($request->all());
        $this->topic->setMentors($topic->id, $request->input('mentors'));
        return redirect()->route('topic.list')->withSuccess(trans('app.topic_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
