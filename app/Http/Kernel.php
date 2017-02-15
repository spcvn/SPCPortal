<?php

namespace SPCVN\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \SPCVN\Http\Middleware\VerifyInstallation::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];
    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \SPCVN\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \SPCVN\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            'throttle:60,1',
            'bindings'
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \SPCVN\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \SPCVN\Http\Middleware\RedirectIfAuthenticated::class,
        'registration' => \SPCVN\Http\Middleware\Registration::class,
        'social.login' => \SPCVN\Http\Middleware\SocialLogin::class,
        'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
        'session.database' => \SPCVN\Http\Middleware\DatabaseSession::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];
}
