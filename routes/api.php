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
Route::post('/movies',              'ApiControllers\MovieController@store')->name('movies.store');
// Read
Route::get('/movies',               'ApiControllers\MovieController@index')->name('movies.index');
Route::get('/movies/{movie}',       'ApiControllers\MovieController@show')->name('movies.show');
// Update
Route::put('/movies/{movie}',       'ApiControllers\MovieController@update')->name('movies.update');
// Delete
Route::delete('/movies/{movie}',    'ApiControllers\MovieController@destroy')->name('movies.destroy');

