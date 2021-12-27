<?php

use Illuminate\Support\Facades\Route;

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


/*----------------------- authentication routes ------------------------*/
Route::group([
    "namespace" => "App\Http\Controllers\Authentication",
], function () {
    Route::get("login", "AuthController@login")
        ->name("login");
    Route::post("login", "AuthController@attempt")
        ->name("login.post");
    Route::get("logout", "AuthController@logout")
        ->name("logout");
});

/*----------------------- posts routes ------------------------*/
Route::group([
    "namespace" => "App\Http\Controllers\Posts",
    "middleware" => "auth:web"
], function () {
    Route::resource("posts", "PostController");
});
