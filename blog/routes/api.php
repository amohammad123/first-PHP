<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'App\Http\Controllers\PostController@index');

Route::get('/posts/{id}', 'App\Http\Controllers\PostController@show');

Route::put('/posts/{id}', 'App\Http\Controllers\PostController@update');

Route::post('/posts', 'App\Http\Controllers\PostController@store');

Route::delete('/posts', 'App\Http\Controllers\PostController@destroy');

Route::post('register', 'App\Http\Controllers\AuthController@register');

Route::post('login', 'App\Http\Controllers\AuthController@login');

Route::post('logout', 'App\Http\Controllers\AuthController@logout');