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



Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});



Auth::routes(['verify' => true]);



Route::get('/', 'EventController@index')->middleware('verified');


Route::get('/event/{id}', 'EventController@show')->middleware('verified');



//--------Profile------------------------//

Route::get('/profile/{id}', 'UserController@show')->middleware('verified')->name('profileindex');

Route::get('/profile/edit/{id}', 'UserController@edit')->middleware('verified')->name('profileedit');

Route::post('/profile/update/{id}', 'UserController@update')->middleware('verified')->name('profileupdate');


//--------Profile------------------------//

//--------For MANAGER-------------------------------------------------------------------------------------------------//
Route::group([
    'prefix' => 'manager/event',
    'middleware' => 'App\Http\Middleware\ManagerMiddleware'
], function () {

    

    //--------Event------------------------//

    Route::get('/add', 'EventController@create')->middleware('verified')->name('eventadd');

    Route::post('/create', 'EventController@store')->middleware('verified')->name('eventcreate');

    Route::get('/{id}/edit', 'EventController@edit')->middleware('verified')->name('eventedit');

    Route::post('/{id}/update', 'EventController@update')->middleware('verified')->name('eventupdate');

    Route::get('/{id}/delete', 'EventController@destroy')->middleware('verified')->name('eventdelete');

    Route::get('/{id}/join', 'EventController@join')->middleware('verified')->name('eventjoin');

    Route::get('/{id}/quit', 'EventController@quit')->middleware('verified')->name('eventjoin');

    Route::get('/{id}/participate', 'EventController@after_join')->middleware('verified')->name('eventparticipate');

    //--------Event------------------------//
});

Route::group([
    'prefix' => 'manager/content',
    'middleware' => 'App\Http\Middleware\ManagerMiddleware'
], function () {
    //--------Content------------------------//

    Route::get('/{id}/add', 'ContentController@create')->middleware('verified');

    Route::post('/{id}/store', 'ContentController@store')->middleware('verified');

    Route::get('/{id}/edit', 'ContentController@edit')->middleware('verified');

    Route::post('/{id}/update', 'ContentController@update')->middleware('verified');

    Route::get('/{id}/delete', 'ContentController@destroy')->middleware('verified');

    //--------Content------------------------//

});
//--------For MANAGER-------------------------------------------------------------------------------------------------//


//--------For ADMIN-------------------------------------------------------------------------------------------------//
Route::group([
    'prefix' => 'admin/event',
    'middleware' => 'App\Http\Middleware\AdminMiddleware'
], function () {
    //--------Event------------------------//
    Route::get('/add', 'EventController@create')->middleware('verified')->name('eventadd');

    Route::post('/create', 'EventController@store')->middleware('verified')->name('eventcreate');

    Route::get('/{id}/edit', 'EventController@edit')->middleware('verified')->name('eventedit');

    Route::post('/{id}/update', 'EventController@update')->middleware('verified')->name('eventupdate');

    Route::get('/{id}/delete', 'EventController@destroy')->middleware('verified')->name('eventdelete');

    Route::get('/{id}/join', 'EventController@join')->middleware('verified')->name('eventjoin');

    Route::get('/{id}/quit', 'EventController@quit')->middleware('verified')->name('eventjoin');

    Route::get('/{id}/participate', 'EventController@after_join')->middleware('verified')->name('eventparticipate');
    //--------Event------------------------//
});

Route::group([
    'prefix' => 'admin/content',
    'middleware' => 'App\Http\Middleware\AdminMiddleware'
], function () {
    //--------Content------------------------//

    Route::get('/{id}/add', 'ContentController@create')->middleware('verified');

    Route::post('/{id}/store', 'ContentController@store')->middleware('verified');

    Route::get('/{id}/edit', 'ContentController@edit')->middleware('verified');

    Route::post('/{id}/update', 'ContentController@update')->middleware('verified');

    Route::get('/{id}/delete', 'ContentController@destroy')->middleware('verified');

    //--------Content------------------------//

});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'App\Http\Middleware\AdminMiddleware'
], function () {
    
    Route::get('/dashboard', 'AdminPanelController@index')->middleware('verified');
    //--------Export------------------------//

    Route::get('/users/export', 'UserController@all')->middleware('verified');
    Route::get('/export/users', 'UserController@export')->middleware('verified');

    Route::get('/events/export', 'EventController@all')->middleware('verified');
    Route::get('/export/events', 'EventController@export')->middleware('verified');

     //--------Export------------------------//
     Route::post('/import/events', 'EventController@import')->middleware('verified');
     //--------Import------------------------//

     //--------Import------------------------//
    //--------Managing Users------------------------//
    Route::get('/users/lists', 'AdminPanelController@users')->middleware('verified');
    Route::get('/users/{id}/edit', 'AdminPanelController@editusers')->middleware('verified');
    Route::post('/users/{id}/update', 'AdminPanelController@updateusers')->middleware('verified');
    Route::get('/users/{id}/delete', 'AdminPanelController@destroyusers')->middleware('verified');
    
    //--------Managing Users------------------------//

    //--------Managing Managers------------------------//
    Route::get('/managers/lists', 'AdminPanelController@managers')->middleware('verified');
    Route::get('/managers/{id}/edit', 'AdminPanelController@editmanagers')->middleware('verified');
    Route::post('/managers/{id}/update', 'AdminPanelController@updatemanagers')->middleware('verified');
    Route::get('/managers/{id}/delete', 'AdminPanelController@destroymanagers')->middleware('verified');

    //--------Managing Managers------------------------//

    //--------Managing Admins------------------------//
    Route::get('/lists', 'AdminPanelController@admins')->middleware('verified');
    Route::get('/{id}/edit', 'AdminPanelController@editadmins')->middleware('verified');
    Route::post('/{id}/update', 'AdminPanelController@updateadmins')->middleware('verified');
    Route::get('/{id}/delete', 'AdminPanelController@destroyadmins')->middleware('verified');

    //--------Managing Admins------------------------//
});
//--------For ADMIN-------------------------------------------------------------------------------------------------//


//--------For Member-------------------------------------------------------------------------------------------------//
Route::group(['middleware' => 'App\Http\Middleware\MemberMiddleware'], function () {
});
//--------For Member-------------------------------------------------------------------------------------------------//

