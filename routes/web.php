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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['admin']], function () {

    Route::get('/', function () {
        return view('home');
    });

    Route::resource('user', 'Admin\UserController');
    Route::resource('support', 'Admin\SupportController');
    Route::resource('service', 'Admin\ServiceController');
    Route::resource('package', 'Admin\PackageController');
    Route::resource('appointment', 'Admin\AppointmentController');

    Route::get('detailers', 'Admin\UserController@detailers')->name('detailers');
    Route::put('change-status/{appointment}', 'Admin\AppointmentController@changeStatus')->name('change-status');
    Route::get('edit-status/{appointment}', 'Admin\AppointmentController@editStatus')->name('edit-status');
    Route::get('getDetailer/{appointment}', 'Admin\AppointmentController@getDetailer')->name('getDetailer');
    Route::get('appointments/{user}', 'Admin\AppointmentController@userAppointments')->name('appointments');

});
