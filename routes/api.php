<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('resetpassword', 'UserController@createResetPasswordToken');
Route::get('resetpassword/{token}', 'UserController@verifyResetPasswordToken');
Route::put('resetpassword', 'UserController@resetPasswordToken');
Route::get('event-types-open/{scheduleCode}', 'User\EventTypeController@getEventTypeByScheduleCode');
Route::post('user/events', 'User\EventController@store');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');

    /* Event Types - Routes */
    Route::get('user/event-types', 'User\EventTypeController@index');
    Route::get('user/event-types/{eventType}', 'User\EventTypeController@show');
    Route::post('user/event-types', 'User\EventTypeController@store');
    Route::put('user/event-types/{eventType}', 'User\EventTypeController@update');
    Route::delete('user/event-types/{eventType}', 'User\EventTypeController@delete');

    /* Users Events  - Routes */
    Route::get('user/events', 'User\EventController@index');
    Route::get('user/events/{event}', 'User\EventController@show');
    Route::put('user/events/{event}', 'User\EventController@update');
    Route::delete('user/events/{event}', 'User\EventController@delete');

});