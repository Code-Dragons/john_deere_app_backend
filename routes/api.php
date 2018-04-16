<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$api = $app->make(Dingo\Api\Routing\Router::class);

$api->version('v1', function ($api) {
    $api->post('/auth/login', [
        'as' => 'api.auth.login',
        'uses' => 'App\Http\Controllers\Auth\AuthController@postLogin',
    ]);

    $api->post('/auth/register', [
        'as' => 'api.register',
        'uses' => 'App\Http\Controllers\Auth\AuthController@register'
    ]);

    $api->group([
        'middleware' => 'api.auth',
    ], function ($api) {
        $api->get('/', [
            'uses' => 'App\Http\Controllers\APIController@getIndex',
            'as' => 'api.index'
        ]);
        $api->get('/auth/user', [
            'uses' => 'App\Http\Controllers\Auth\AuthController@getUser',
            'as' => 'api.auth.user'
        ]);
        $api->patch('/auth/refresh', [
            'uses' => 'App\Http\Controllers\Auth\AuthController@patchRefresh',
            'as' => 'api.auth.refresh'
        ]);
        $api->delete('/auth/invalidate', [
            'uses' => 'App\Http\Controllers\Auth\AuthController@deleteInvalidate',
            'as' => 'api.auth.invalidate'
        ]);
    });

    $api->group([
        'middleware' => 'api.auth',
    ], function ($api) {
        $api->post('/groups', [
            'uses' => 'App\Http\Controllers\GroupController@create',
            'as' => 'api.create'
        ]);

        $api->get('/users', [
            'uses' => 'App\Http\Controllers\GroupController@getUsers',
            'as' => 'api.users'
        ]);

        $api->get('/tractors', [
            'uses' => 'App\Http\Controllers\GroupController@getTractors',
            'as' => 'api.tractors'
        ]);

        $api->post('/tractors/select', [
            'uses' => 'App\Http\Controllers\GroupController@selectTractor',
            'as' => 'api.tractors.select'
        ]);

        $api->get('/auth/report/{user_id}', [
            'uses' => 'App\Http\Controllers\Report\ReportController@getStats',
            'as' => 'api.auth.user.report'
        ]);
    });
});
