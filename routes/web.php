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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('/', 'EventController@index')->middleware('verified');

//--------Profile------------------------//
Route::get('/profile/{id}', 'UserController@index')->middleware('verified');;

Route::get('/profile/{id}', 'UserController@show')->middleware('verified');

Route::get('/profile/edit/{id}', 'UserController@edit')->middleware('verified');

Route::post('/profile/update/{id}', 'UserController@update')->middleware('verified');

//--------Profile------------------------//

//--------Event------------------------//

Route::get('/event/add', 'EventController@create')->middleware('verified');

Route::post('/event/create', 'EventController@store')->middleware('verified');

Route::get('/event/{id}/edit','EventController@edit')->middleware('verified');

Route::post('/event/{id}/update','EventController@update')->middleware('verified');

Route::get('/event/{id}/delete','EventController@destroy')->middleware('verified');

Route::get('/event/{id}/join','EventController@join')->middleware('verified');

Route::post('/event/{id}/participate','EventController@participate')->middleware('verified');

//--------Event------------------------//

//--------Content------------------------//

Route::get('/content/{id}', [
    'as' => 'ContentPage', 'uses' => 'EventController@show'
])->middleware('verified');

Route::get('/content/{id}/add', 'ContentController@create')->middleware('verified');

Route::post('/content/{id}/store', 'ContentController@store')->middleware('verified');

Route::get('/content/{id}/edit', 'ContentController@edit')->middleware('verified');

Route::post('/content/{id}/update', 'ContentController@update')->middleware('verified');

Route::get('/content/{id}/delete', 'ContentController@destroy')->middleware('verified');

//--------Content------------------------//









