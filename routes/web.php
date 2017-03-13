<?php

/**
 * Authentication
 */

Route::get('login', 'Auth\AuthController@getLogin');
Route::get('testconnection', 'TestController@index');



Route::post('login', 'Auth\AuthController@postLogin');

Route::get('logout', [
    'as' => 'auth.logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

// Allow registration routes only if registration is enabled.
if (settings('reg_enabled')) {
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('register/confirmation/{token}', [
        'as' => 'register.confirm-email',
        'uses' => 'Auth\AuthController@confirmEmail'
    ]);
}

// Register password reset routes only if it is enabled inside website settings.
if (settings('forgot_password')) {
    Route::get('password/remind', 'Auth\PasswordController@forgotPassword');
    Route::post('password/remind', 'Auth\PasswordController@sendPasswordReminder');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
}

/**
 * Two-Factor Authentication
 */
if (settings('2fa.enabled')) {
    Route::get('auth/two-factor-authentication', [
        'as' => 'auth.token',
        'uses' => 'Auth\AuthController@getToken'
    ]);

    Route::post('auth/two-factor-authentication', [
        'as' => 'auth.token.validate',
        'uses' => 'Auth\AuthController@postToken'
    ]);
}

/**
 * Social Login
 */
Route::get('auth/{provider}/login', [
    'as' => 'social.login',
    'uses' => 'Auth\SocialAuthController@redirectToProvider',
    'middleware' => 'social.login'
]);

Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('auth/twitter/email', 'Auth\SocialAuthController@getTwitterEmail');
Route::post('auth/twitter/email', 'Auth\SocialAuthController@postTwitterEmail');

/**
 * Other
 */

Route::get('/', [
    'as' => 'dashboard',
    'uses' => 'DashboardController@index'
]);

/**
 * User Profile
 */

Route::get('profile', [
    'as' => 'profile',
    'uses' => 'ProfileController@index'
]);

Route::get('profile/activity', [
    'as' => 'profile.activity',
    'uses' => 'ProfileController@activity'
]);

Route::put('profile/details/update', [
    'as' => 'profile.update.details',
    'uses' => 'ProfileController@updateDetails'
]);

Route::post('profile/avatar/update', [
    'as' => 'profile.update.avatar',
    'uses' => 'ProfileController@updateAvatar'
]);

Route::post('profile/avatar/update/external', [
    'as' => 'profile.update.avatar-external',
    'uses' => 'ProfileController@updateAvatarExternal'
]);

Route::put('profile/login-details/update', [
    'as' => 'profile.update.login-details',
    'uses' => 'ProfileController@updateLoginDetails'
]);

Route::put('profile/social-networks/update', [
    'as' => 'profile.update.social-networks',
    'uses' => 'ProfileController@updateSocialNetworks'
]);

Route::post('profile/two-factor/enable', [
    'as' => 'profile.two-factor.enable',
    'uses' => 'ProfileController@enableTwoFactorAuth'
]);

Route::post('profile/two-factor/disable', [
    'as' => 'profile.two-factor.disable',
    'uses' => 'ProfileController@disableTwoFactorAuth'
]);

Route::get('profile/sessions', [
    'as' => 'profile.sessions',
    'uses' => 'ProfileController@sessions'
]);

Route::delete('profile/sessions/{session}/invalidate', [
    'as' => 'profile.sessions.invalidate',
    'uses' => 'ProfileController@invalidateSession'
]);

/**
 * User Management
 */
Route::get('user', [
    'as' => 'user.list',
    'uses' => 'UsersController@index'
]);

Route::get('user/create', [
    'as' => 'user.create',
    'uses' => 'UsersController@create'
]);

Route::post('user/create', [
    'as' => 'user.store',
    'uses' => 'UsersController@store'
]);

Route::get('user/{user}/show', [
    'as' => 'user.show',
    'uses' => 'UsersController@view'
]);

Route::get('user/{user}/edit', [
    'as' => 'user.edit',
    'uses' => 'UsersController@edit'
]);

Route::put('user/{user}/update/details', [
    'as' => 'user.update.details',
    'uses' => 'UsersController@updateDetails'
]);

Route::put('user/{user}/update/login-details', [
    'as' => 'user.update.login-details',
    'uses' => 'UsersController@updateLoginDetails'
]);

Route::delete('user/{user}/delete', [
    'as' => 'user.delete',
    'uses' => 'UsersController@delete'
]);

Route::post('user/{user}/update/avatar', [
    'as' => 'user.update.avatar',
    'uses' => 'UsersController@updateAvatar'
]);

Route::post('user/{user}/update/avatar/external', [
    'as' => 'user.update.avatar.external',
    'uses' => 'UsersController@updateAvatarExternal'
]);

Route::post('user/{user}/update/social-networks', [
    'as' => 'user.update.socials',
    'uses' => 'UsersController@updateSocialNetworks'
]);

Route::get('user/{user}/sessions', [
    'as' => 'user.sessions',
    'uses' => 'UsersController@sessions'
]);

Route::delete('user/{user}/sessions/{session}/invalidate', [
    'as' => 'user.sessions.invalidate',
    'uses' => 'UsersController@invalidateSession'
]);

Route::post('user/{user}/two-factor/enable', [
    'as' => 'user.two-factor.enable',
    'uses' => 'UsersController@enableTwoFactorAuth'
]);

Route::post('user/{user}/two-factor/disable', [
    'as' => 'user.two-factor.disable',
    'uses' => 'UsersController@disableTwoFactorAuth'
]);

/**
 * Roles & Permissions
 */

Route::get('role', [
    'as' => 'role.index',
    'uses' => 'RolesController@index'
]);

Route::get('role/create', [
    'as' => 'role.create',
    'uses' => 'RolesController@create'
]);

Route::post('role/store', [
    'as' => 'role.store',
    'uses' => 'RolesController@store'
]);

Route::get('role/{role}/edit', [
    'as' => 'role.edit',
    'uses' => 'RolesController@edit'
]);

Route::put('role/{role}/update', [
    'as' => 'role.update',
    'uses' => 'RolesController@update'
]);

Route::delete('role/{role}/delete', [
    'as' => 'role.delete',
    'uses' => 'RolesController@delete'
]);


Route::post('permission/save', [
    'as' => 'permission.save',
    'uses' => 'PermissionsController@saveRolePermissions'
]);

Route::resource('permission', 'PermissionsController');

/**
 * Settings
 */

Route::get('settings', [
    'as' => 'settings.general',
    'uses' => 'SettingsController@general',
    'middleware' => 'permission:settings.general'
]);

Route::post('settings/general', [
    'as' => 'settings.general.update',
    'uses' => 'SettingsController@update',
    'middleware' => 'permission:settings.general'
]);

Route::get('settings/auth', [
    'as' => 'settings.auth',
    'uses' => 'SettingsController@auth',
    'middleware' => 'permission:settings.auth'
]);

Route::post('settings/auth', [
    'as' => 'settings.auth.update',
    'uses' => 'SettingsController@update',
    'middleware' => 'permission:settings.auth'
]);

// Only allow managing 2FA if AUTHY_KEY is defined inside .env file
if (env('AUTHY_KEY')) {
    Route::post('settings/auth/2fa/enable', [
        'as' => 'settings.auth.2fa.enable',
        'uses' => 'SettingsController@enableTwoFactor',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::post('settings/auth/2fa/disable', [
        'as' => 'settings.auth.2fa.disable',
        'uses' => 'SettingsController@disableTwoFactor',
        'middleware' => 'permission:settings.auth'
    ]);
}

Route::post('settings/auth/registration/captcha/enable', [
    'as' => 'settings.registration.captcha.enable',
    'uses' => 'SettingsController@enableCaptcha',
    'middleware' => 'permission:settings.auth'
]);

Route::post('settings/auth/registration/captcha/disable', [
    'as' => 'settings.registration.captcha.disable',
    'uses' => 'SettingsController@disableCaptcha',
    'middleware' => 'permission:settings.auth'
]);

Route::get('settings/notifications', [
    'as' => 'settings.notifications',
    'uses' => 'SettingsController@notifications',
    'middleware' => 'permission:settings.notifications'
]);

Route::post('settings/notifications', [
    'as' => 'settings.notifications.update',
    'uses' => 'SettingsController@update',
    'middleware' => 'permission:settings.notifications'
]);

/**
 * Activity Log
 */

Route::get('activity', [
    'as' => 'activity.index',
    'uses' => 'ActivityController@index'
]);

Route::get('activity/user/{user}/log', [
    'as' => 'activity.user',
    'uses' => 'ActivityController@userActivity'
]);

/**
 * Installation
 */

$router->get('install', [
    'as' => 'install.start',
    'uses' => 'InstallController@index'
]);

$router->get('install/requirements', [
    'as' => 'install.requirements',
    'uses' => 'InstallController@requirements'
]);

$router->get('install/permissions', [
    'as' => 'install.permissions',
    'uses' => 'InstallController@permissions'
]);

$router->get('install/database', [
    'as' => 'install.database',
    'uses' => 'InstallController@databaseInfo'
]);

$router->get('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/install-app', [
    'as' => 'install.install',
    'uses' => 'InstallController@install'
]);

$router->get('install/complete', [
    'as' => 'install.complete',
    'uses' => 'InstallController@complete'
]);

$router->get('install/error', [
    'as' => 'install.error',
    'uses' => 'InstallController@error'
]);

/* Categories */
Route::get('category', [
    'as' => 'category.list',
    'uses' => 'CategoryController@index'
]);

Route::get('category/create', [
    'as' => 'category.create',
    'uses' => 'CategoryController@create'
]);

Route::post('category/create', [
    'as' => 'category.store',
    'uses' => 'CategoryController@store'
]);

Route::get('category/{category}/edit', [
    'as' => 'category.edit',
    'uses' => 'CategoryController@edit'
]);

Route::put('category/{category}/edit', [
    'as' => 'category.update',
    'uses' => 'CategoryController@update'
]);

Route::post('category', [
    'as' => 'category.sort',
    'uses' => 'CategoryController@updatePosition'
]);

Route::delete('category/{category}/delete', [
    'as' => 'category.delete',
    'uses' => 'CategoryController@delete'
]);
/* End Categories */


/* Topics */
Route::get('topic', [
    'as' => 'topic.list',
    'uses' => 'TopicsController@index'
]);

Route::get('topic/create', [
    'as' => 'topic.create',
    'uses' => 'TopicsController@create'
]);

Route::post('topic/create', [
    'as' => 'topic.store',
    'uses' => 'TopicsController@store'
]);

Route::get('topic/{topic}/edit', [
    'as' => 'topic.edit',
    'uses' => 'TopicsController@edit'
]);

Route::put('topic/{topic}/edit', [
    'as' => 'topic.update',
    'uses' => 'TopicsController@update'
]);

Route::post('topic', [
    'as' => 'topic.sort',
    'uses' => 'TopicsController@updatePosition'
]);

Route::post('topic/{topic}/memtor', [
    'as' => 'topic.memtor',
    'uses' => 'TopicsController@getMemtorsByTopicId'
]);

Route::delete('topic/{topic}/delete', [
    'as' => 'topic.delete',
    'uses' => 'TopicsController@delete'
]);
/* End Topics */

/**
 * Questions
 */
Route::get('question', [
    'as' => 'question.index',
    'uses' => 'QuestionsController@index'
]);

Route::get('question/create', [
    'as' => 'question.create',
    'uses' => 'QuestionsController@create'
]);

Route::post('question/store', [
    'as' => 'question.store',
    'uses' => 'QuestionsController@store'
]);

Route::get('question/{question}/edit', [
    'as' => 'question.edit',
    'uses' => 'QuestionsController@edit'
]);

Route::put('question/{question}/update', [
    'as' => 'question.update',
    'uses' => 'QuestionsController@update'
]);

Route::delete('question/{question}/delete', [
    'as' => 'question.delete',
    'uses' => 'QuestionsController@delete'
]);


/**
 * Answers
 */
Route::get('answer', [
    'as' => 'answer.index',
    'uses' => 'AnswersController@index'
]);

Route::get('answer/create', [
    'as' => 'answer.create',
    'uses' => 'AnswersController@create'
]);

Route::post('answer/store', [
    'as' => 'answer.store',
    'uses' => 'AnswersController@store'
]);

Route::get('answer/{answer}/edit', [
    'as' => 'answer.edit',
    'uses' => 'AnswersController@edit'
]);

Route::put('answer/{answer}/update', [
    'as' => 'answer.update',
    'uses' => 'AnswersController@update'
]);

Route::delete('answer/{answer}/delete', [
    'as' => 'answer.delete',
    'uses' => 'AnswersController@delete'
]);

/**
 * Tags
 */
Route::get('tag', [
    'as' => 'tag.index',
    'uses' => 'TagsController@index'
]);

Route::get('tag/create', [
    'as' => 'tag.create',
    'uses' => 'TagsController@create'
]);

Route::post('tag/store', [
    'as' => 'tag.store',
    'uses' => 'TagsController@store'
]);

Route::get('tag/{tag}/edit', [
    'as' => 'tag.edit',
    'uses' => 'TagsController@edit'
]);

Route::put('tag/{tag}/update', [
    'as' => 'tag.update',
    'uses' => 'TagsController@update'
]);

Route::delete('tag/{tag}/delete', [
    'as' => 'tag.delete',
    'uses' => 'TagsController@delete'
]);

Route::get('tag/find', [
    'as' => 'tag.find',
    'uses' => 'TagsController@find'
]);

/**
 * Members
 */
Route::get('topic/{topic}/show', [
    'as' => 'user.show',
    'uses' => 'UsersController@view'
]);
