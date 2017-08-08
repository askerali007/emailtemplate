<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();
Route::get('/', [

	'uses' => 'HomeController@index',
]);

Route::get('/home', 'HomeController@index');
Route::get('/users/', [
        'as' => 'users.index',
	'uses' => 'UsersController@index',
]);

Route::get('/users/update', [
        'as' => 'users.update',
	'uses' => 'UsersController@update',
]);

Route::get('/users/{status}', [
        'as' => 'users.index',
	'uses' => 'UsersController@index',
]);


Route::get('/user/view/{id}', [

	'uses' => 'UsersController@view',
]);
Route::get('/user/profile', [

	'uses' => 'UsersController@profile',
]);
Route::get('/templates', [
        'as' => 'templates.index',
	'uses' => 'TemplatesController@index',
]);

Route::get('/templates/preview/{id}', [
        'as' => 'templates.preview',
	'uses' => 'TemplatesController@preview',
]);





