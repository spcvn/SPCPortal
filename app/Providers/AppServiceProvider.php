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
use SPCVN\Repositories\Answer\EloquentAnswer;
use SPCVN\Repositories\Answer\AnswerRepository;
use SPCVN\Repositories\Tag\EloquentTag;
use SPCVN\Repositories\Tag\TagRepository;
use SPCVN\Repositories\QuestionTag\EloquentQuestionTag;
use SPCVN\Repositories\QuestionTag\QuestionTagRepository;
use SPCVN\Repositories\QuestionMenter\EloquentQuestionMenter;
use SPCVN\Repositories\QuestionMenter\QuestionMenterRepository;
use SPCVN\Repositories\Session\DbSession;
use SPCVN\Repositories\Session\SessionRepository;
use SPCVN\Repositories\User\EloquentUser;
use SPCVN\Repositories\User\UserRepository;

use SPCVN\Repositories\Category\EloquentCategory;
use SPCVN\Repositories\Category\CategoryRepository;
use SPCVN\Repositories\Topic\EloquentTopic;
use SPCVN\Repositories\Topic\TopicRepository;

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
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);

        //2017-03-09 Nguyen Hien add
        $this->app->singleton(QuestionRepository::class, EloquentQuestion::class);
        $this->app->singleton(QuestionTagRepository::class, EloquentQuestionTag::class);
        $this->app->singleton(QuestionMenterRepository::class, EloquentQuestionMenter::class);
        $this->app->singleton(AnswerRepository::class, EloquentAnswer::class);
        $this->app->singleton(TagRepository::class, EloquentTag::class);

        // @huongdi
        $this->app->singleton(CategoryRepository::class, EloquentCategory::class);
        $this->app->singleton(TopicRepository::class, EloquentTopic::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
