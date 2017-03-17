<?php

namespace SPCVN\Events\Topic;

use SPCVN\Topic;

abstract class TopicEvent
{
    /**
     * @var Topic
     */
    protected $topic;

    /**
     * @var Mentors
     */
    protected $mentors;

    /**
     * @var Mentors
     */
    protected $oldMentors;

    public function __construct(Topic $topic, $mentors = [], $oldMentors = [])
    {
        $this->topic        = $topic;
        $this->mentors      = $mentors;
        $this->oldMentors   = $oldMentors;
    }

    /**
     * @return topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Get mentors ID
     *
     * @return array
     */
    public function getMentors()
    {
        return $this->mentors;
    }

    /**
     * Get old mentors ID
     *
     * @return array
     */
    public function getOldMentors()
    {
        return $this->oldMentors;
    }
}