<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'v1'], function () {

    Route::post('register', 'API\v1\AuthController@register');
    Route::post('login', 'API\v1\AuthController@login');

});


Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {


    Route::post('users/{user}/follow', 'API\v1\UsersFollowController@follow');
    Route::get('timeline', 'API\v1\TimelineController@index');
    Route::post('tweets/', 'API\v1\TweetsController@store');
    Route::delete('tweets/{tweet}', 'API\v1\TweetsController@destroy');

});

