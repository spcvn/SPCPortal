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
    }

    public function onUpdate(Updated $event)
    {
        $message = trans(
            'log.updated_topic',
            ['name' => $event->getTopic()->topic_name]
        );

        $this->logger->log($message);
    }

    public function onDelete(Deleted $event)
    {
        $message = trans(
            'log.deleted_topic',
            ['name' => $event->getTopic()->topic_name]
        );

        $this->logger->log($message);
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
