<?php

namespace SPCVN\Listeners;

use SPCVN\Activity;
use SPCVN\Events\Topic\Created;
use SPCVN\Events\Topic\Deleted;
use SPCVN\Events\Topic\Updated;
use SPCVN\Services\Logging\UserActivity\Logger;

class TopicEventsSubscriber
{
    /**
     * @var UserActivityLogger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onCreate(Created $event)
    {
        $message = trans(
            'log.new_topic',
            ['name' => $event->getTopic()->topic_name]
        );

        $this->logger->log($message);

        // add hashtag mentors
        $mentors = $event->getMentors();
        foreach ($mentors as $mentor) {
            $message = trans(
                'log.hashtag_mentor',
                ['name' => $event->getTopic()->topic_name]
            );

            $this->logger->logV1($message, $mentor);
        }
    }

    public function onUpdate(Updated $event)
    {
        $message = trans(
            'log.updated_topic',
            ['name' => $event->getTopic()->topic_name]
        );

        $this->logger->log($message);

        // Log activity for mentor users.
        $mentors    = $event->getMentors();
        $oldMentors = $event->getOldMentors();

        // add hashtag mentors
        $addMentorsDiff = array_diff($mentors, $oldMentors);
        foreach ($addMentorsDiff as $addMentor) {
            $message = trans(
                'log.hashtag_mentor',
                ['name' => $event->getTopic()->topic_name]
            );

            $this->logger->logV1($message, $addMentor);
        }

        // remove hashtag mentors
        $delMentorsDiff = array_diff($oldMentors, $mentors);
        foreach ($delMentorsDiff as $delMentor) {
            $message = trans(
                'log.remove_hashtag_mentor',
                ['name' => $event->getTopic()->topic_name]
            );

            $this->logger->logV1($message, $delMentor);
        }
    }

    public function onDelete(Deleted $event)
    {
        $message = trans(
            'log.deleted_topic',
            ['name' => $event->getTopic()->topic_name]
        );

        $this->logger->log($message);

        // add hashtag mentors
        $mentors = $event->getMentors();
        foreach ($mentors as $mentor) {
            $message = trans(
                'log.deleted_topic_hashtag',
                ['name' => $event->getTopic()->topic_name]
            );

            $this->logger->logV1($message, $mentor);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'SPCVN\Listeners\TopicEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}
