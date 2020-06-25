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

Route::get('/content/{id}', 'EventController@show')->middleware('verified');



//--------Profile------------------------//

Route::get('/profile/{id}', 'UserController@show')->middleware('verified')->name('profileindex');

Route::get('/profile/edit/{id}', 'UserController@edit')->middleware('verified')->name('profileedit');

Route::post('/profile/update/{id}', 'UserController@update')->middleware('verified')->name('profileupdate');



//--------Profile------------------------//

Route::group([
    'prefix' => 'manager',
    'middleware' => 'App\Http\Middleware\ManagerMiddleware'
], function () {


    //--------Event------------------------//

    Route::get('/event/add', 'EventController@create')->middleware('verified')->name('eventadd');

    Route::post('/event/create', 'EventController@store')->middleware('verified')->name('eventcreate');

    Route::get('/event/{id}/edit', 'EventController@edit')->middleware('verified')->name('eventedit');

    Route::post('/event/{id}/update', 'EventController@update')->middleware('verified')->name('eventupdate');

    Route::get('/event/{id}/delete', 'EventController@destroy')->middleware('verified')->name('eventdelete');

    Route::get('/event/{id}/join', 'EventController@join')->middleware('verified')->name('eventjoin');

    Route::post('/event/{id}/participate', 'EventController@participate')->middleware('verified')->name('eventparticipate');

    //--------Event------------------------//



    //--------Content------------------------//

    Route::get('/content/{id}/add', 'ContentController@create')->middleware('verified');

    Route::post('/content/{id}/store', 'ContentController@store')->middleware('verified');

    Route::get('/content/{id}/edit', 'ContentController@edit')->middleware('verified');

    Route::post('/content/{id}/update', 'ContentController@update')->middleware('verified');

    Route::get('/content/{id}/delete', 'ContentController@destroy')->middleware('verified');

    //--------Content------------------------//

});

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

    Route::post('/{id}/participate', 'EventController@participate')->middleware('verified')->name('eventparticipate');
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

Route::group(['middleware' => 'App\Http\Middleware\MemberMiddleware'], function () {
});
