<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get("/", "HomeController@home");

Route::get('/projects', 'ProjectController@showProjects');

Route::get('/project/create', 'ProjectController@create');
Route::post("/project/store", "ProjectController@store");

Route::get("/project/{slug}", "ProjectController@showProject");
Route::get('/project/edit/{slug}', 'ProjectController@edit');
Route::put('/project/update/{slug}', 'ProjectController@update');
Route::delete('/project/delete/{slug}', 'ProjectController@delete');