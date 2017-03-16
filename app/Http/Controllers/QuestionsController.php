<?php

namespace SPCVN\Http\Controllers;

use DB;
use Cache;
use SPCVN\Question;
use SPCVN\QuestionTag;
use SPCVN\QuestionMenter;
use SPCVN\Events\Question\Created;
use SPCVN\Events\Question\Deleted;
use SPCVN\Events\Question\Updated;
use SPCVN\Http\Requests\Question\CreateQuestionRequest;
use SPCVN\Http\Requests\Question\UpdateQuestionRequest;
use SPCVN\Repositories\Question\QuestionRepository;
use SPCVN\Repositories\Topic\TopicRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class QuestionsController
 * @package SPCVN\Http\Controllers
 */
class QuestionsController extends Controller
{
    /**
     * @var QuestionRepository
     */
    private $questions;

    /**
     * QuestionsController constructor.
     * @param QuestionRepository $questions
     */
    public function __construct(QuestionRepository $questions)
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

        dd($questions);

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
     * @param CreateQuestionRequest $request
     * @return mixed
     */
    public function store(CreateQuestionRequest $request)
    {
        DB::beginTransaction();

        try {

            $this->questions->create($request->all());
            $this->questions->createNewTagIfNotExisis($request->user_id, $request->tag_ids);
            DB::commit();

            return redirect()->route('question.index')->withSuccess(trans('app.question_created'));

        } catch(\Exception $e) {

            DB::rollback();
            throw $e;
        }
    }

    /**
     * Display for for editing specified question.
     *
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Question $question)
    {
        $edit = true;

        return view('role.add-edit', compact('edit', 'question'));
    }

    /**
     * Update specified question with provided data.
     *
     * @param Question $question
     * @param UpdateQuestionRequest $request
     * @return mixed
     */
    public function update(UpdateQuestionRequest $request)
    {
        return redirect()->route('question.index')
            ->withSuccess(trans('app.question_updated'));
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
