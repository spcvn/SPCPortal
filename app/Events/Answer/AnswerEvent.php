<?php

namespace SPCVN\Events\Answer;

use SPCVN\Answer;

abstract class AnswerEvent
{
    /**
     * @var Answer
     */
    protected $answer;

    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
