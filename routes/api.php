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

Route::middleware('api')->get('/movies', 'Movies@index');
Route::middleware('api')->post('/movies', 'Movies@store');
Route::middleware('api')->get('/movies/{id}', 'Movies@show');
Route::middleware('api')->put('/movies/{id}', 'Movies@update');
Route::middleware('api')->delete('/movies/{id}', 'Movies@destroy');




