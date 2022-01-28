<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login','App\Http\Controllers\API\LoginController@login');
Route::post('/register','App\Http\Controllers\API\RegiserController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('/profile','App\Http\Controllers\API\ProfileController@index');
    Route::put('/profile/update/','App\Http\Controllers\API\ProfileController@update');
    Route::put('/profile/updatePassword/','App\Http\Controllers\API\ProfileController@updatePassword');
});
