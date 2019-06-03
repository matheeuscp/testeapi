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

Route::group(['prefix' => '/user', 'middleware' => 'cors'], function(){

    Route::get('',      ['uses' => 'UserController@allUsers']);
    Route::get('/{id}', ['uses' => 'UserController@getUser']);
    Route::post('/',    ['uses' => 'UserController@saveUser']);
    Route::put('/{id}', ['uses' => 'UserController@updateUser']);
    Route::delete('/{id}', ['uses' => 'UserController@deleteUser']);
});