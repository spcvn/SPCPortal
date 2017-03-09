<?php

namespace SPCVN\Repositories\Question;

use SPCVN\Events\Question\Created;
use SPCVN\Events\Question\Deleted;
use SPCVN\Events\Question\Updated;
use SPCVN\Question;
use SPCVN\Support\Authorization\CacheFlusherTrait;
use DB;

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
    public function lists($column = 'name', $key = 'id')
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
        return Question::where('name', $name)->first();
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
     * {@inheritdoc}
     */
    public function allTopics()
    {
        return Question::all();
    }
}
