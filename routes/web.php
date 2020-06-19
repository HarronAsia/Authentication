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


Auth::routes(['verify' => true]);

Route::get('/home', 'UserController@index')->middleware('verified');

Route::get('/posts', 'PostsController@index')->middleware('verified');

Route::resource('posts', 'PostsController');

Route::get('/profile/{id}', 'UserController@index')->middleware('verified');;






