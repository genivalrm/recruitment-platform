<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('curriculum', 'CurriculumController')->middleware('auth');
Route::get('curriculum/{id}/tag', 'CurriculumController@listTag');
Route::delete('curriculum/{id}/tag', 'CurriculumController@deletTag');
Route::post('curriculum/{id}/tag', 'CurriculumController@insertTag');
Route::post('curriculum/{id}/rating', 'CurriculumController@updateStar');
Route::resource('/', 'HomeController');
Route::get('auth', 'LoginController@index');
Route::post('auth', 'LoginController@authenticate');
Route::get('auth/logout', 'LoginController@logout');