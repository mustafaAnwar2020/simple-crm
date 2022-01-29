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

Route::post('/login','App\Http\Controllers\API\LoginController@login');
Route::post('/register','App\Http\Controllers\API\RegiserController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('/profile','App\Http\Controllers\API\ProfileController@index');
    Route::put('/profile/update/','App\Http\Controllers\API\ProfileController@update');
    Route::put('/profile/updatePassword/','App\Http\Controllers\API\ProfileController@updatePassword');
    Route::get('/clients','App\Http\Controllers\API\ClientsController@index');
    // Route::get('/clients/trash','App\Http\Controllers\API\ClientsController@trashedClients');
    Route::post('/clients/create','App\Http\Controllers\API\ClientsController@store');
    Route::put('/clients/update/{id}','App\Http\Controllers\API\ClientsController@update');
    Route::delete('/clients/{id}','App\Http\Controllers\API\ClientsController@destroy');
    // Route::delete('/clients/delete/{id}','App\Http\Controllers\API\ClientsController@delete');
    // Route::get('/clients/restore/{id}','App\Http\Controllers\API\ClientsController@restore');
    Route::get('/projects','App\Http\Controllers\API\ProjectsController@index');
    // Route::get('/projects/trash','App\Http\Controllers\API\ProjectsController@trashedProjects');
    Route::get('/projects/show/{id}','App\Http\Controllers\API\ProjectsController@show');
    Route::post('/projects/create','App\Http\Controllers\API\ProjectsController@store');
    Route::put('/projects/update/{id}','App\Http\Controllers\API\ProjectsController@update');
    Route::delete('/projects/{id}','App\Http\Controllers\API\ProjectsController@destroy');
    Route::apiResource('/Tasks','App\Http\Controllers\API\TasksController');
});
