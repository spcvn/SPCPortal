<?php

namespace SPCVN\Http\Controllers;

use Cache;
use SPCVN\Tag;
use SPCVN\Events\Tag\Created;
use SPCVN\Events\Tag\Deleted;
use SPCVN\Events\Tag\Updated;
use SPCVN\Http\Requests\Tag\CreateTagRequest;
use SPCVN\Http\Requests\Tag\UpdateTagRequest;
use SPCVN\Repositories\Tag\TagRepository;
use SPCVN\Repositories\Topic\TopicRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class TagsController
 * @package SPCVN\Http\Controllers
 */
class TagsController extends Controller
{
    /**
     * @var QuestionRepository
     */
    private $tags;

    /**
     * QuestionsController constructor.
     * @param QuestionRepository $questions
     */
    public function __construct(TagRepository $questions)
    {
        // $this->middleware('permission:questions.manage');
        $this->questions = $questions;
    }

    /**
     * Display page with all available questions.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $questions = $this->questions->all();

        return view('question.index', compact('questions'));
    }

    /**
     * Display form for creating new role.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(TopicRepository $topicRepository)
    {
        $edit = false;
        $topics = $topicRepository->lists();

        return view('question.add-edit', compact('topics', 'edit'));
    }

    /**
     * Store newly created role to database.
     *
     * @param CreateRoleRequest $request
     * @return mixed
     */
    public function store(CreateRoleRequest $request)
    {
        $this->roles->create($request->all());

        return redirect()->route('role.index')
            ->withSuccess(trans('app.role_created'));
    }

    /**
     * Display for for editing specified role.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $edit = true;

        return view('role.add-edit', compact('edit', 'role'));
    }

    /**
     * Update specified role with provided data.
     *
     * @param Role $role
     * @param UpdateRoleRequest $request
     * @return mixed
     */
    public function update(UpdateQuestionRequest $request)
    {
        return redirect()->route('question.index')
            ->withSuccess(trans('app.role_updated'));
    }

    /**
     * Remove specified role from system.
     *
     * @param Role $role
     * @param UserRepository $userRepository
     * @return mixed
     */
    public function delete(Role $role, UserRepository $userRepository)
    {
        if (! $role->removable) {
            throw new NotFoundHttpException;
        }

        $userRole = $this->roles->findByName('User');

        $userRepository->switchRolesForUsers($role->id, $userRole->id);

        $this->roles->delete($role->id);

        Cache::flush();

        return redirect()->route('role.index')
            ->withSuccess(trans('app.role_deleted'));
    }
}
