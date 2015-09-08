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

Route::get('/', 'BmcController@index');
Route::get('home', 'BmcController@index');

Route::get('test', 'TestController@index');

Route::get('bmc', 'BmcController@index');
Route::get('bmc/create/{id?}', 'BmcController@create');
Route::post('bmc/save/{id}', 'BmcController@save');
Route::get('bmc/edit/{id}', 'BmcController@edit');
Route::get('bmc/copyBmc/{id}', 'BmcController@copyBmc');
Route::get('bmc/delete/{id}','BmcController@deleteBMC');
Route::get('bmc/viewBMC/{id}', 'BmcController@viewBMC');
Route::post('bmc/savePostIt/{id}', 'BmcController@savePostIt');
Route::get('bmc/deletePostIt/{id}', 'BmcController@deletePostIt');
Route::post('bmc/changeStatus/{id}', 'BmcController@changeStatus');
Route::post('bmc/changePostItStatus/{id}', 'BmcController@changePostItStatus');
Route::post('bmc/addPersona/{id}', 'BmcController@addPersona');
Route::get('bmc/deleteAssignedPersona/{id}', 'BmcController@deleteAssignedPersona');
Route::get('bmc/models', 'BmcController@models');
Route::get('bmc/createModel', 'BmcController@createModel');
Route::post('bmc/saveModel', 'BmcController@saveModel');

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

Route::get('export/{id}', 'ExportController@index');
Route::get('export/export/{id}', 'ExportController@export');

Route::get('profile', 'ProfileController@index');
Route::post('profile/save/{id}', 'ProfileController@save');

Route::get('project_bmc_view', 'ProjectBmcViewController@index');

Route::get('team', 'TeamController@index');
Route::get('team/create', 'TeamController@create');
Route::get('team/delete/{id}', 'TeamController@delete');
Route::post('team/addUserToProject', 'TeamController@addUserToProject');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
