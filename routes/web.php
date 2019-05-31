<?php

Route::group(['prefix' => 'api'], function(){
    Route::group(['prefix' => 'user'], function(){

        Route::get('',      ['uses' => 'UserController@allUsers']);
        Route::get('/{id}', ['uses' => 'UserController@getUser']);
        Route::post('/',    ['uses' => 'UserController@saveUser']);
        Route::put('/{id}', ['uses' => 'UserController@updateUser']);
        Route::delete('/{id}', ['uses' => 'UserController@deleteUser']);
    });
});