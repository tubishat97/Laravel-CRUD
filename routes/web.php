<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'TasksController@index');
Route::get('/add-task-form', 'TasksController@create')->name('add-task-form');
Route::get('/edit-task-form{id}', 'TasksController@edit')->name('edit-task-form');
Route::get('/delete-modal/{id}', 'TasksController@deleteModal')->name('delete-modal');

Route::post('/store', 'TasksController@store')->name('store-task');
Route::post('/edit/{id}', 'TasksController@update')->name('edit-task');
Route::delete('/delete-task/{id}','TasksController@destroy')->name('delete-task');

