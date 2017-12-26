<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Movies CRUD
// Create
Route::post('/movies',              'ApiControllers\MovieController@store')->name('movies.store')->middleware('auth:api');
// Read
Route::get('/movies',               'ApiControllers\MovieController@index')->name('movies.index')->middleware('auth:api');
Route::get('/movies/{movie}',       'ApiControllers\MovieController@show')->name('movies.show')->middleware('auth:api');
// Update
Route::put('/movies/{movie}',       'ApiControllers\MovieController@update')->name('movies.update')->middleware('auth:api');
// Delete
Route::delete('/movies/{movie}',    'ApiControllers\MovieController@destroy')->name('movies.destroy')->middleware('auth:api');

