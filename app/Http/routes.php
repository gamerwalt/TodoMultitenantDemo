<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/',
    [
        'as' => 'home',
        'uses' => 'HomeController@home'
    ]);

    Route::get('session/register',
    [
        'as' => 'session.register',
        'uses' => 'SessionsController@register'
    ]);

    Route::post('session/register',
    [
        'as' => 'session.register',
        'uses' => 'SessionsController@postRegister'
    ]);

    Route::get('session/signin',
    [
        'as' => 'session.signin',
        'uses' => 'SessionsController@signIn'
    ]);

    Route::get('login',
    [
        'as' => 'login',
        'uses' => 'SessionsController@signIn'
    ]);

    Route::post('session/signin',
    [
        'as' => 'session.signin',
        'uses' => 'SessionsController@postSignIn'
    ]);

    Route::get('session/signout',
    [
        'as' => 'tenant.signout',
        'uses' => 'SessionsController@signOut'
    ]);

    Route::get('dashboard',
    [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);

    Route::get('todos',
    [
        'as' => 'todos',
        'uses' => 'TodosController@index'
    ]);

    Route::get('todo/create',
    [
        'as' => 'todo.create',
        'uses' => 'TodosController@create'
    ]);

    Route::post('todo/create',
    [
        'as' => 'todo.create',
        'uses' => 'TodosController@postCreate'
    ]);

    Route::get('todo/toggle/{body}',
    [
        'as' => 'todo.toggle',
        'uses' => 'TodosController@toggle'
    ]);
});
