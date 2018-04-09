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

Route::get('/', 'StudentsController@index');

Route::resource('students', \App\Http\Controllers\StudentsController::class);

Route::get('search', 'StudentsController@search');

Route::get('results', 'StudentsController@results');