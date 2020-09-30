<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where the web routes is registered for the application.
| These routes are loaded by the RouteServiceProvider within 
| a group which contains the "web" middleware group.
|
*/

Auth::routes();

Route::get('/admin', 'Admin\HomeController@index')->name('admin');
