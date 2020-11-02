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

    Route::resource('user',  'Admin\UserController');
    Route::resource('appointment', 'Admin\AppointmentController');


    Route::get('appointments/{user}', 'Admin\AppointmentController@userAppointments')->name('appointments');

});
