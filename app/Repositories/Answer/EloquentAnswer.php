<?php

namespace SPCVN\Repositories\Answer;

use SPCVN\Answer;
use SPCVN\Events\Answer\Created;
use SPCVN\Events\Answer\Deleted;
use SPCVN\Events\Answer\Updated;
use SPCVN\Support\Authorization\CacheFlusherTrait;
use DB;

class EloquentAnswer implements AnswerRepository
{
    use CacheFlusherTrait;

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Answer::all();
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'name', $key = 'id')
    {
        return Answer::pluck($column, $key);
    }


    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Answer::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $answer = Answer::with('user', 'question')->create($data);

        event(new Created($answer));

        return $answer;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $answer = $this->find($id);

        $answer->update($data);

        // event(new Updated($answer));

        return $answer;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $answer = $this->find($id);

        // event(new Deleted($answer));

        return $answer->delete();
    }
}
