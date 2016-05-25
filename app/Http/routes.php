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
    Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
    Route::get('room', ['as'=>'room.index', 'uses' => 'RoomController@index']);
    Route::get('room/{roomId}', ['as'=>'room.show', 'uses' => 'RoomController@show']);
    Route::get('/login', ['as' => 'login', 'uses' => 'UsersController@index']);
    Route::post('/login', ['as' => 'login', 'uses' => 'UsersController@login']);
    Route::get('/publish', 'RoomController@publish');
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('upspace', ['as' => 'upspace', 'uses' => 'UsersController@space']);
    Route::post('/roomupdate/{roomId}', ['as'=>'room.update', 'uses' => 'RoomController@update']);
    Route::post('/roomdestroy/{roomId}', ['as'=>'room.destroy', 'uses' => 'RoomController@destroy']);
});
