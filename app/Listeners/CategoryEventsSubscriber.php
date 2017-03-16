<?php

namespace SPCVN\Listeners;

use SPCVN\Activity;
use SPCVN\Events\Category\Created;
use SPCVN\Events\Category\Deleted;
use SPCVN\Events\Category\Updated;
use SPCVN\Services\Logging\UserActivity\Logger;

class CategoryEventsSubscriber
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
            'log.new_category',
            ['name' => $event->getCategory()->name]
        );

        $this->logger->log($message);
    }

    public function onUpdate(Updated $event)
    {
        $message = trans(
            'log.updated_category',
            ['name' => $event->getCategory()->name]
        );

        $this->logger->log($message);
    }

    public function onDelete(Deleted $event)
    {
        $message = trans(
            'log.deleted_category',
            ['name' => $event->getCategory()->name]
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
        $class = 'SPCVN\Listeners\CategoryEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}
