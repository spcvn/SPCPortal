<?php

namespace SPCVN\Http\Controllers;

use DB;
use Cache;
use SPCVN\Tag;
use SPCVN\User;
use SPCVN\Question;
use SPCVN\QuestionMenter;
use Illuminate\Http\Request;
use SPCVN\Events\Question\Created;
use SPCVN\Events\Question\Deleted;
use SPCVN\Events\Question\Updated;
use Illuminate\Support\Facades\Auth;
use SPCVN\Http\Requests\Question\CreateQuestionRequest;
use SPCVN\Http\Requests\Question\UpdateQuestionRequest;
use SPCVN\Repositories\Question\QuestionRepository;
use SPCVN\Repositories\Topic\TopicRepository;
use SPCVN\Repositories\Tag\TagRepository;
use SPCVN\Repositories\User\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class QuestionsController
 * @package SPCVN\Http\Controllers
 */

define('ACTIVE', 'Active' );
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
        $this->middleware('permission:questions.manage');
        $this->questions = $questions;
    }

    /**
     * Display page with all available questions.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = 10;

        $questions = $this->questions->paginateQuestions(Auth::user()->id, $perPage, $request->get('search'));

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
        $topics = $this->parseTopics(Auth::user()->id, $topicRepository);
        $topic_id_created='';

        return view('question.add-edit', compact('topics', 'edit', 'topic_id_created'));
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

                    //create new question
                    $question = $this->questions->create($request->all());

                    $tag_ids = ($request->tag_ids)?$request->tag_ids:'';

                    $mentor_ids = ($request->mentor_ids)?$request->mentor_ids:'';

                    $int_ids = array();
                    if(!empty($tag_ids)) {

                            $int_ids = array_filter($tag_ids, 'is_numeric');

                            //check tag
                            $tags = $this->questions->createNewTagIfNotExisis($request->user_id, $tag_ids);

                            //regist tag_ids
                            $new_tag_ids = ($this->questions->setTagId($tags))?$this->questions->setTagId($tags):$int_ids;

                            $tag_ids_regist = '';
                            if(!empty($int_ids)) $tag_ids_regist = array_merge($int_ids, $new_tag_ids);

                            //insert question tag into DB
                            $this->questions->setQuestionTag($question->id, $tag_ids_regist, true);
                    }

                    //insert question menters into DB
                    $this->questions->setQuestionMenter($question->id, $mentor_ids, true);

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
    public function edit(Question $question, TopicRepository $topicRepository, TagRepository $tagRepository, UserRepository $userRepository)
    {
            $edit = true;
            $tags = ($this->getTags($tagRepository))?$this->getTags($tagRepository):'';
            $mentors = ($this->getMentors($userRepository))?$this->getMentors($userRepository):'';

            //question tags
            $tag_createds=array();
            $questions_tags=($question->question_tag)?$question->question_tag:'';

            foreach ($questions_tags as $key => $tag) {

                    $tag_createds[] = $tag->id;
            }

            //question menters
            $mentor_createds=array();
            $questions_mentors=($question->question_mentor)?$question->question_mentor:'';

            foreach ($questions_mentors as $key => $mentor) {

                    $mentor_createds[] = $mentor->id;
            }

            $topics = $this->parseTopics(Auth::user()->id, $topicRepository);
            $topic_id_created = ($question->topic_id !== 0)?$question->topic_id:'';

            return view('question.add-edit', compact('edit', 'question', 'topics', 'tags', 'tag_createds', 'mentors', 'mentor_createds', 'topic_id_created'));
    }

    /**
     * Update specified question with provided data.
     *
     * @param Question $question
     * @param UpdateQuestionRequest $request
     * @return mixed
     */
    public function update(Question $question, UpdateQuestionRequest $request)
    {

            DB::beginTransaction();

            try {

                    //update question
                    $question = $this->questions->update($question->id, $request->all());

                    $tag_ids = ($request->tag_ids)?$request->tag_ids:'';

                    $mentor_ids = ($request->mentor_ids)?$request->mentor_ids:'';

                    if(!empty($tag_ids)) {

                            $int_ids = array();
                            $int_ids = array_filter($tag_ids, 'is_numeric');

                            //check tag
                            $tags = $this->questions->createNewTagIfNotExisis($request->user_id, $tag_ids);

                            //regist tag_ids
                            $new_tag_ids = ($this->questions->setTagId($tags))?$this->questions->setTagId($tags):$int_ids;

                            $tag_ids_regist = '';
                            if(!empty($int_ids)) $tag_ids_regist = array_merge($int_ids, $new_tag_ids);
                            if(empty($tag_ids_regist)) $tag_ids_regist = $new_tag_ids;

                            //insert question tags into DB
                            $this->questions->setQuestionTag($question->id, $tag_ids_regist, true);

                    } else {

                            //insert question tags into DB
                            $this->questions->setQuestionTag($question->id, $tag_ids, true);
                    }

                    //insert question menters into DB
                    $this->questions->setQuestionMenter($question->id, $mentor_ids, true);

                    DB::commit();
                    return redirect()->route('question.index')->withSuccess(trans('app.question_updated'));

            } catch(\Exception $e) {

                    DB::rollback();
                    throw $e;
            }

    }

    /**
     * Displays question information page.
     *
     * @param User $user
     * @param ActivityRepository $activities
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Question $question)
    {
            $question = $this->questions->detail($question->id);

            // dd($question["answers"]);

            return view('question.detail', compact('question'));
    }

    /**
     * Remove specified question from system.
     *
     * @param Question $question
     * @return mixed
     */
    public function delete(Question $question)
    {
            // if (! $question->removable) {

            //         throw new NotFoundHttpException;
            // }

            $this->questions->delete($question->id);

            Cache::flush();

            return redirect()->route('question.index')->withSuccess(trans('app.question_deleted'));
    }

    /**
     * Parse topics into an array that also has a blank
     * item as first element, which will allow users to
     * @param TopicRepository $topicRepository
     * @return array
     */
    private function parseTopics($user_id, TopicRepository $topicRepository)
    {
            return [0 => 'Select a Topic'] + $topicRepository->listsTopicByUser($user_id);
    }

    /**
     * get tags list
     *
     * @param TagRepository $tagRepository
     * @return array;
     */
    private function getTags(TagRepository $tagRepository)
    {
            return $tags=$tagRepository->lists();
    }

    /**
     * get mentors list
     *
     * @param UserRepository $userRepository
     * @return array;
     */
    private function getMentors(UserRepository $userRepository)
    {
            return $memtors=$userRepository->getUserByStatus(ACTIVE)->pluck('full_name', 'id')->toArray();
    }


}
