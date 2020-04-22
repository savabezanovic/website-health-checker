<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailtrapExample;
use App\Mail\ProjectDownNotification;
use App\Mail\ProjectUpNotification;
use Illuminate\Support\Facades\Mail;

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
Route::get("/home", "HomeController@home");


Route::get('/projects', 'ProjectController@showProjects');

Route::get('/project/create', 'ProjectController@create');
Route::post("/project/store", "ProjectController@store");

Route::get("/project/{slug}", "ProjectController@showProject");
Route::get('/project/edit/{slug}', 'ProjectController@edit');
Route::put('/project/update/{slug}', 'ProjectController@update');
Route::delete('/project/delete/{slug}', 'ProjectController@delete');

Route::get("project/{slug}/urls", "ProjectUrlController@showUrls");
Route::get("project/{slug}/add/url", "ProjectUrlController@add");
Route::post("/project/{slug}/store/url", "ProjectUrlController@store");
Route::get("/project/{slug}/edit/url/{id}", "ProjectUrlController@edit");
Route::put("/project/update/url/{id}", "ProjectUrlController@update");
Route::delete("/project/delete/url/{id}", "ProjectUrlController@delete");

Route::get("/user/settings", "UserController@settings");

Route::get("/project/{slug}/notifications", "ProjectController@showNotifications");

Route::put("/notificationSetting/{id}", "ProjectController@notificationSetting");

Route::put("/user/{id}/settingON", "UserController@notificationON");
Route::put("/user/{id}/settingOFF", "UserController@notificationOFF");

Route::post("/invite/{id}", "UserController@sendInvitation");

Route::get("/join-team/{token}", "UserController@joinTeam");

Route::get("/test", "TestController@test");

Route::get("/project/make-public-link/{slug}", "ProjectController@makePublicLink");
Route::get("/project/public/{hash}", "ProjectController@showPublicProject");