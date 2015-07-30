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

Route::get('/', 'WelcomeController@index');

Route::get('test', 'TestController@index');

Route::get('bmc', 'BmcController@index');
Route::get('bmc/create/{id?}', 'BmcController@create');
Route::post('bmc/save/{id}', 'BmcController@save');
Route::get('bmc/edit/{id}', 'BmcController@edit');
Route::get('bmc/delete/{id}','BmcController@deleteBMC');
Route::get('bmc/viewBMC/{id}', 'BMCController@viewBMC');
Route::post('bmc/savePostIt/{id}', 'BMCController@savePostIt');
Route::get('bmc/deletePostIt/{id}', 'BMCController@deletePostIt');
Route::post('bmc/changeStatus/{id}', 'BMCController@changeStatus');

Route::get('projects', 'ProjectsController@index');
Route::get('projects/create', 'ProjectsController@create');
Route::post('projects/save/{id?}', 'ProjectsController@save');
Route::get('projects/edit/{id}', 'ProjectsController@edit');
Route::get('projects/delete/{id}','ProjectsController@deleteProject');
Route::get('projects/showBMCs/{id}', 'ProjectsController@showBMCs');

Route::get('notice/save/{id?}', 'NoticeController@save');
Route::get('notice/edit/{id}', 'NoticeController@edit');
Route::get('notice/delete/{id}','NoticeController@deleteProject');

Route::get('persona', 'PersonaController@index');
Route::get('persona/create/{id}', 'PersonaController@create');
Route::post('persona/save/{id?}', 'PersonaController@save');
Route::get('persona/edit/{id}', 'PersonaController@edit');
Route::get('persona/delete/{id}','PersonaController@deletePersona');

Route::get('profile', 'ProfileController@index');
Route::post('profile/save/{}', 'ProfileController@save');
Route::get('profile/edit/{id}', 'ProfileController@edit');

Route::get('project_bmc_view', 'ProjectBmcViewController@index');

Route::get('team', 'TeamController@index');
Route::get('team/create', 'TeamController@create');
Route::post('team/save/{id?}', 'TeamController@save');
Route::get('team/edit/{id}', 'TeamController@edit');
Route::get('team/delete/{id}','TeamController@deleteTeamMember');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);