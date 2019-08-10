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

Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');

Route::middleware('auth:api')->group( function () {


    Route::get('users/follow/{user}', 'API\UsersFollowController@follow');
    Route::get('timeline', 'API\TimelineController@index');
    Route::post('tweets/', 'API\TweetsController@store');
    Route::delete('tweets/{tweet}', 'API\TweetsController@destroy');

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
