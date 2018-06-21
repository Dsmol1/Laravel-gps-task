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

Route::get('/', function () {
    return view('layouts.master');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/task', 'TaskController@index')->name('task');

Route::post('/task/store', 'TaskController@store')->name('task.store');

Route::get('/admin', 'AdminController@index')->name('admin');
