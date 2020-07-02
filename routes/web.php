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

Route::post('/profile/edit/confirm/{id}', 'UserController@confirm')->middleware('verified')->name('profileedit');

Route::post('/profile/update/{id}', 'UserController@update')->middleware('verified')->name('profileupdate');


//--------Profile------------------------//

//--------For MANAGER-------------------------------------------------------------------------------------------------//
Route::group([
    'prefix' => 'manager/event',
    'middleware' => 'App\Http\Middleware\ManagerMiddleware'
], function () {



    //--------Event------------------------//

    Route::get('/add', 'EventController@create')->middleware('verified')->name('eventadd');

    //Confirm Add Event    
    Route::post('/add/confirm', 'EventController@confirmstore')->middleware('verified');
    //Confirm Add Event

    Route::post('/create', 'EventController@store')->middleware('verified')->name('eventcreate');

    Route::get('/{id}/edit', 'EventController@edit')->middleware('verified')->name('eventedit');

    Route::post('/{id}/update', 'EventController@update')->middleware('verified')->name('eventupdate');

    //Confirm Update Event
    Route::post('/{id}/update/confirm', 'EventController@confirmupdate')->middleware('verified');
    //Confirm Update Event

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

    //Confirm Add Event    
    Route::post('/add/confirm', 'ContentController@confirmstore')->middleware('verified');
    //Confirm Add Event

    Route::post('/{id}/store', 'ContentController@store')->middleware('verified');

    Route::get('/{id}/edit', 'ContentController@edit')->middleware('verified');

    //Confirm Update Event
    Route::post('/{id}/update/confirm', 'ContentController@confirmupdate')->middleware('verified');
    //Confirm Update Event  

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

    //Confirm Add Event
    Route::post('/add/confirm', 'EventController@confirmadd')->middleware('verified');
    //Confirm Add Event

    Route::post('/create', 'EventController@store')->middleware('verified')->name('eventcreate');


    Route::get('/{id}/edit', 'EventController@edit')->middleware('verified')->name('eventedit');

    //Confirm Update Event
    Route::post('/{id}/update/confirm', 'EventController@confirmupdate')->middleware('verified');
    //Confirm Update Event

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

    //Confirm Add Content
    Route::post('/{id}/add/confirm', 'ContentController@confirmadd')->middleware('verified');
    //Confirm Add Content

    Route::post('/{id}/store', 'ContentController@store')->middleware('verified');

    Route::get('/{id}/edit', 'ContentController@edit')->middleware('verified');

    //Confirm Update Content
    Route::post('/{id}/update/confirm', 'ContentController@confirmupdate')->middleware('verified');
    //Confirm Update Content

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
    Route::get('/member/lists', 'AdminPanelController@users')->middleware('verified');
    Route::get('/member/{id}/edit', 'AdminPanelController@editmember')->middleware('verified');
    Route::post('/member/{id}/confirm', 'AdminPanelController@confirmMember')->middleware('verified');
    Route::post('/member/{id}/update', 'AdminPanelController@updateusers')->middleware('verified');
    Route::get('/member/{id}/delete', 'AdminPanelController@destroyusers')->middleware('verified');

    //--------Managing Users------------------------//

    //--------Managing Managers------------------------//
    Route::get('/manager/lists', 'AdminPanelController@managers')->middleware('verified');
    Route::get('/manager/{id}/edit', 'AdminPanelController@editmanager')->middleware('verified');
    Route::post('/manager/{id}/confirm', 'AdminPanelController@confirmManager')->middleware('verified');
    Route::post('/manager/{id}/update', 'AdminPanelController@updatemanagers')->middleware('verified');
    Route::get('/manager/{id}/delete', 'AdminPanelController@destroymanagers')->middleware('verified');

    //--------Managing Managers------------------------//

    //--------Managing Admins------------------------//
    Route::get('/lists', 'AdminPanelController@admins')->middleware('verified');
    Route::get('/admin/{id}/edit', 'AdminPanelController@editadmin')->middleware('verified');
    Route::post('/admin/{id}/confirm', 'AdminPanelController@confirmforAdmin')->middleware('verified');
    Route::post('/admin/{id}/update', 'AdminPanelController@updateadmins')->middleware('verified');
    Route::get('/admin/{id}/delete', 'AdminPanelController@destroyadmins')->middleware('verified');

    //--------Managing Admins------------------------//

    
});
//--------For ADMIN-------------------------------------------------------------------------------------------------//


//--------For Member-------------------------------------------------------------------------------------------------//
Route::group(['middleware' => 'App\Http\Middleware\MemberMiddleware'], function () {
});
//--------For Member-------------------------------------------------------------------------------------------------//
