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
Route::post('/login', 'Auth\LoginController@authenticate');

Route::middleware('jwt')->get('/movies', 'Movies@index');
Route::middleware('jwt')->post('/movies', 'Movies@store');
Route::middleware('jwt')->get('/movies/{id}', 'Movies@show');
Route::middleware('jwt')->put('/movies/{id}', 'Movies@update');
Route::middleware('jwt')->delete('/movies/{id}', 'Movies@destroy');




