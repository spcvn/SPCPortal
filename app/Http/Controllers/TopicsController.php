<?php

namespace SPCVN\Http\Controllers;


use SPCVN\Repositories\User\UserRepository;
use SPCVN\Repositories\Topic\TopicRepository;
//use SPCVN\Http\Requests\Topic\CreateCategoryRequest;
//use SPCVN\Http\Requests\Topics\UpdateCategoryRequest;
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
     * @var CategoryRepository
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
    public function index()
    {
        $topics = $this->topic->paginate();

        echo 'list topic';exit;
        
        // echo '<pre>';
        // print_r($this->topic->lists());
        // echo '</pre>';
        // exit;

        return view('topic.list', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
