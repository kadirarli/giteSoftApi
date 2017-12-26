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

// home
Route::get('/',         'WebControllers\HomeController@index')->name('home');

// auth routes
Auth::routes();

// admin
Route::get('/admin',    'WebControllers\AdminController@index')->name('admin');

// settings
Route::get('/settings', 'WebControllers\SettingsController@index')->name('settings')->middleware('auth');