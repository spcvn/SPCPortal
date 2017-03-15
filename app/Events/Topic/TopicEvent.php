<?php

namespace SPCVN\Events\Topic;

use SPCVN\Topic;

abstract class TopicEvent
{
    /**
     * @var Topic
     */
    protected $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * @return topic
     */
    public function getTopic()
    {
        return $this->topic;
    }
}