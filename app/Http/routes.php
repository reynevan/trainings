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



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('/exercises/user/{user_id?}', 'ExercisesController@userExercises');
Route::resource('exercises', 'ExercisesController');

Route::get('/trainings/user/{user_id?}', 'TrainingsController@userTrainings');
Route::resource('/trainings', 'TrainingsController');
Route::post('trainings/{id}/add_serie', 'TrainingsController@addSerie');

Route::get('/token', 'UsersController@token');
Route::get('/auth_id', 'UsersController@auth_id');
