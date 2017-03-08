<?php

namespace SPCVN\Providers;

use Carbon\Carbon;
use SPCVN\Repositories\Activity\ActivityRepository;
use SPCVN\Repositories\Activity\EloquentActivity;
use SPCVN\Repositories\Country\CountryRepository;
use SPCVN\Repositories\Country\EloquentCountry;
use SPCVN\Repositories\Permission\EloquentPermission;
use SPCVN\Repositories\Permission\PermissionRepository;
use SPCVN\Repositories\Role\EloquentRole;
use SPCVN\Repositories\Role\RoleRepository;
use SPCVN\Repositories\Question\EloquentQuestion;
use SPCVN\Repositories\Question\QuestionRepository;
use SPCVN\Repositories\Session\DbSession;
use SPCVN\Repositories\Session\SessionRepository;
use SPCVN\Repositories\User\EloquentUser;
use SPCVN\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        config(['app.name' => settings('app_name')]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(QuestionRepository::class, EloquentQuestion::class);
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
