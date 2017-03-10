<?php

namespace SPCVN\Repositories\Question;

use DB;
use SPCVN\Question;
use SPCVN\QuestionTag;
use SPCVN\QuestionMenter;
use SPCVN\Events\Question\Created;
use SPCVN\Events\Question\Deleted;
use SPCVN\Events\Question\Updated;
use SPCVN\Support\Authorization\CacheFlusherTrait;

class EloquentQuestion implements QuestionRepository
{
    use CacheFlusherTrait;

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
    public function lists($column = 'title', $key = 'id')
    {
        return Question::pluck($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function findById($id)
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
    public function delete($id)
    {
        $question = $this->find($id);

        event(new Deleted($question));

        return $question->delete();
    }

    /**
     * Create new question mentor.
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
}
