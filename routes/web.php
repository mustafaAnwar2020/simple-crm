<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use GuzzleHttp\Middleware;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->name('profile.index');
    Route::post('/profile/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
    Route::post('/profile/password', 'App\Http\Controllers\ProfileController@changePassword')->name('profile.changePassword');
    Route::get('/clients/trash', 'App\Http\Controllers\clientsController@trashedClients')->name('clients.trash');
    Route::get('/clients/restore/{Client}', 'App\Http\Controllers\clientsController@restore')->name('clients.restore');
    Route::delete('/clients/delete/{Client}', 'App\Http\Controllers\clientsController@delete')->name('clients.delete');
    Route::resource('/clients', 'App\Http\Controllers\clientsController');
    Route::get('/projects/trash','App\Http\Controllers\projectController@trashedProjects')->name('projects.trash');
    Route::get('/projects/restore/{project}','App\Http\Controllers\projectController@restore')->name('project.restore');
    Route::delete('/projects/delete/{project}','App\Http\Controllers\projectController@delete')->name('project.delete');
    Route::resource('/projects','App\Http\Controllers\projectController');
    Route::get('/tasks/trash','App\Http\Controllers\tasksController@trashedTasks')->name('tasks.trash');
    Route::get('/tasks/restore/{task}','App\Http\Controllers\tasksController@restore')->name('tasks.restore');
    Route::delete('/tasks/delete/{task}','App\Http\Controllers\tasksController@delete')->name('tasks.delete');
    Route::resource('/tasks','App\Http\Controllers\tasksController');
    Route::resource('/users','App\Http\Controllers\UserController');
    Route::resource('/roles','App\Http\Controllers\RolesController');
});
