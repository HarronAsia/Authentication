<?php

use App\Http\Controllers\PostsController;
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



Auth::routes();

Route::get('/', 'UserController@index')->name('home');

Route::get('/verify', 'Auth\RegisterController@verifyUser');

Auth::routes(['verify' => true]);

Route::get('/home', 'EventController@index')->middleware('verified');


Route::get('/profile/{id}', 'UserController@index')->middleware('verified');;

Route::get('/profile/{id}', 'UserController@show')->middleware('verified');

Route::get('/profile/edit/{id}', 'UserController@edit')->middleware('verified');

Route::post('/profile/update/{id}', 'UserController@update')->middleware('verified');

Route::get('/event/add', 'EventController@create')->middleware('verified');

Route::post('/event/create', 'EventController@store')->middleware('verified');

Route::get('/content/{id}', 'EventController@show')->middleware('verified');

Route::get('/content/{id}/add', 'ContentController@create')->middleware('verified');

Route::post('/content/{id}/store', 'ContentController@store')->middleware('verified');









