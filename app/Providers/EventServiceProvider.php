<?php

namespace SPCVN\Providers;

use SPCVN\Events\User\Registered;
use SPCVN\Listeners\PermissionEventsSubscriber;
use SPCVN\Listeners\RoleEventsSubscriber;
use SPCVN\Listeners\UserEventsSubscriber;
use SPCVN\Listeners\UserWasRegisteredListener;
use SPCVN\Listeners\CategoryEventsSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [UserWasRegisteredListener::class]
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        UserEventsSubscriber::class,
        RoleEventsSubscriber::class,
        PermissionEventsSubscriber::class,
        CategoryEventsSubscriber::class
    ];

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
