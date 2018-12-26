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

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::get('/currencies', 'Api\CurrenciesController@index');
Route::get('/currencies/{date}', 'Api\CurrenciesController@show');

Route::post('/up-balance', 'Api\ProfileController@upBalance');
Route::post('/transfer', 'Api\ProfileController@transfer');
Route::get('/users/{name}', 'Api\UserController@show');
