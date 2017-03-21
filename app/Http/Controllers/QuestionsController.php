<?php

namespace SPCVN\Http\Controllers;

use DB;
use Cache;
use SPCVN\Tag;
use SPCVN\Question;
use SPCVN\QuestionMenter;
use Illuminate\Http\Request;
use SPCVN\Events\Question\Created;
use SPCVN\Events\Question\Deleted;
use SPCVN\Events\Question\Updated;
use SPCVN\Http\Requests\Question\CreateQuestionRequest;
use SPCVN\Http\Requests\Question\UpdateQuestionRequest;
use SPCVN\Repositories\Question\QuestionRepository;
use SPCVN\Repositories\Topic\TopicRepository;
use SPCVN\Repositories\Tag\TagRepository;
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
    public function index(Request $request)
    {
        $perPage = 10;

        $questions = $this->questions->paginateQuestions($perPage, $request->get('search'));

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
        $topics = $this->parseTopics($topicRepository);

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

                    //create new question
                    $question = $this->questions->create(array_map('trim', $request->all()));

                    $tag_ids = ($request->tag_ids)?$request->tag_ids:'';

                    $int_ids = array();
                    if(!empty($tag_ids)) {

                            $int_ids = array_filter($tag_ids, 'is_numeric');

                            //check tag
                            $tags = $this->questions->createNewTagIfNotExisis($request->user_id, $tag_ids);

                            //regist tag_ids
                            $new_tag_ids = ($this->setTagId($tags))?$this->setTagId($tags):$int_ids;

                            $tag_ids_regist = '';
                            if(!empty($int_ids)) $tag_ids_regist = array_merge($int_ids, $new_tag_ids);

                            //insert question tag into DB
                            $this->questions->setQuestionTag($question->id, $tag_ids_regist, true);

                    } else {

                            //insert question tag into DB
                            $this->questions->setQuestionTag($question->id, $tag_ids, true);

                    }

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
    public function edit(Question $question, TopicRepository $topicRepository, TagRepository $tagRepository)
    {
            $edit = true;
            $tags = ($this->getTags($tagRepository))?$this->getTags($tagRepository):'';

            $tag_createds=array();
            $questions_tags=($question->question_tag)?$question->question_tag:'';

            foreach ($questions_tags as $key => $tag) {

                $tag_createds[] = $tag->id;
            }

            $topics = $this->parseTopics($topicRepository);

            return view('question.add-edit', compact('edit', 'question', 'topics', 'tags', 'tag_createds'));
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

                    if(!empty($tag_ids)) {

                            $int_ids = array();
                            $int_ids = array_filter($tag_ids, 'is_numeric');

                            //check tag
                            $tags = $this->questions->createNewTagIfNotExisis($request->user_id, $tag_ids);

                            //regist tag_ids
                            $new_tag_ids = ($this->setTagId($tags))?$this->setTagId($tags):$int_ids;

                            $tag_ids_regist = '';
                            if(!empty($int_ids)) $tag_ids_regist = array_merge($int_ids, $new_tag_ids);
                            if(empty($tag_ids_regist)) $tag_ids_regist = $new_tag_ids;

                            //insert question tag into DB
                            $this->questions->setQuestionTag($question->id, $tag_ids_regist, true);

                    } else {

                            //insert question tag into DB
                            $this->questions->setQuestionTag($question->id, $tag_ids, true);
                    }

                    DB::commit();
                    return redirect()->route('question.index')->withSuccess(trans('app.question_updated'));

            } catch(\Exception $e) {

                    DB::rollback();
                    throw $e;
            }

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
    private function parseTopics(TopicRepository $topicRepository)
    {
            return [0 => 'Select a Topic'] + $topicRepository->lists()->toArray();
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
     * get tags list
     *
     * @param TagRepository $tagRepository
     * @return array;
     */
    private function getTagsByQuestionId($question_id)
    {
            return $tags=$tagRepository->lists();
    }

    /**
     * set tag id
     *
     * @param $tags
     * @return array();
     */
    private function setTagId($tags)
    {
            $res=[];

            foreach ($tags as $key => $tag) {

                    $res[] =  (string)$tag->id;
            }

            return $res;
    }

}
