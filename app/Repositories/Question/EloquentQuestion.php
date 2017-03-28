<?php

namespace SPCVN\Repositories\Question;

use DB;
use SPCVN\Tag;
use SPCVN\User;
use SPCVN\Question;
use SPCVN\QuestionTag;
use SPCVN\QuestionMenter;
use SPCVN\Events\Question\Created;
use SPCVN\Events\Question\Deleted;
use SPCVN\Events\Question\Updated;
use Illuminate\Pagination\Paginator;
use SPCVN\Repositories\Tag\TagRepository;
use SPCVN\Support\Authorization\CacheFlusherTrait;

class EloquentQuestion implements QuestionRepository
{
    use CacheFlusherTrait;

    /**
     * @var TagRepository
     */
    private $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Question::all();
    }

    /**
     * {@inheritdoc}
     */
    public function paginateQuestions($user_id, $perPage = 10, $search = null)
    {
        $query = Question::with('topic', 'user', 'question_tag');

        return $this->paginateAndFilterResults($user_id, $perPage, $search, $query);
    }

    /**
     * @param $perPage
     * @param $search
     * @param $query
     * @return mixed
     */
    private function paginateAndFilterResults($user_id, $perPage, $search, $query)
    {
        $result = $this->getQuestionListByUser($user_id, $perPage, $search, $query);

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'title', $key = 'id')
    {
        return Question::where('del_flg', false)->pluck($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Question::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        return Question::where('title', $name)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $question = Question::create($data);

        event(new Created($question));

        return $question;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $question = $this->find($id);

        $question->update($data);

        event(new Updated($question));

        return $question;
    }

     /**
     * {@inheritdoc}
     */
    public function setQuestionTag($question_id, $tag_id, $flg='false')
    {
        $data = [];
        if (is_array($tag_id) && !empty($tag_id[0])) {

            $data = $tag_id;
        }

        return $this->find($question_id)->question_tag()->sync($data, $flg);
    }

    /**
     * {@inheritdoc}
     */
    public function setQuestionMenter($question_id, $mentor_id, $flg='false')
    {
        $data = [];
        if (is_array($mentor_id) && !empty($mentor_id[0])) {

            $data = $mentor_id;
        }

        return $this->find($question_id)->question_mentor()->sync($data, $flg);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $question = $this->find($id);

        $question->del_flg = true;

        event(new Updated($question));

        return $question->save();
    }

    /**
     * {@inheritdoc}
     */
    public function createQuestionMentors($question_id, $user_id)
    {
        $question_id = is_array($question_id) ? $question_id : [$question_id];

        return $this->find($user_id)->roles()->sync($question_id);
    }

    /**
     * {@inheritdoc}
     */
    public function createQuestionTags($question_id, $tag_ids=array())
    {
        $data=array();
        $data['question_id'] = $question_id;
        foreach ($tag_ids as $key => $tag_id) {

            $data['tag_id'] = $tag_id;
        }
        return QuestionTag::create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function createNewTagIfNotExisis($user_id, array $data)
    {
        $res=array();
        $tag=array();
        $tag["user_id"]=$user_id;

        foreach ($data as $key => $item) {

            if (!is_numeric($item)) {

                if($this->checkTagExists($item)) {

                    $tag["name"]=$item;
                    $res[] = $this->tags->create($tag);
                }
            }
        }

        return $res;
    }

    /**
     * {@inheritdoc}
     */
    public function checkTagExists($name)
    {
        $res=true;
        if(Tag::where('name', '=', $name)
            ->where('del_flg', '=', false)
            ->count() > 0) {

            $res=false;
        }

        return $res;
    }

    /**
     * {@inheritdoc}
     */
    private function getQuestionListByUser($user_id, $perPage, $search, $query)
    {
        $question_list=[];

        if ($search) {
            $query->where('title', 'LIKE', "%$search%");
        }

        // get question from questions table
        $results = $query->where('public', true)
                ->where('del_flg', false)
                ->where('user_id', $user_id)
                ->orderBy('created_at', 'DESC');

        if ($search) $results->appends(['search' => $search]);

        foreach ($results->get() as $result) {

            $question_list[] = $result;
        }

        // get question id from questions mentors
        $user = User::find($user_id);
        $questions=$user->questions;

        foreach ($questions as $question) {

            $question_list[] = $question;
        }

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($question_list, count($question_list), $perPage);
        $paginator->setPath(route('question.index'));

        return $paginator;
    }

    /**
     * {@inheritdoc}
     */
    public function detail($id)
    {
        $res=[];
        $question = Question::with('user', 'answer')->find($id);
        $res["question"] = $question;

        foreach ($question->answer as $key => $answer) {

            if($answer->parent_id === 0) {

                $res["answers"][$answer->id]['answer'] = $answer;
            } else {

                $res["answers"][$answer->parent_id]['sub'][] = $answer;
            }
        }

        return $res;
    }
}
