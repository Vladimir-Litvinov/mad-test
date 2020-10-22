<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::post('register', 'Auth\RegisterController@register');

Route::post('forgot-password', 'AuthController@forgotPassword');

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('change-password', 'AuthController@updatePassword');

    Route::get('profile', 'UserController@profile');

    Route::get('packages', 'PackageController@index');
    Route::get('packages/{package}', 'PackageController@show');
    Route::post('packages', 'PackageController@store');
    Route::get('custom-packages', 'PackageController@myPackages');

    Route::group(['middleware' => ['owner_package:package']], function () {
        Route::put('packages/{package}', 'PackageController@update');
        Route::delete('packages/{package}', 'PackageController@destroy');
    });

    Route::get('packages-by-categories/{category}', 'PackageController@getByCategory');
    Route::get('services', 'PackageController@services');
    Route::get('my-addresses', 'AppointmentController@addresses');

    Route::get('support','SupportController@index');

    Route::post('rejects','RejectController@store');



    Route::get('appointments', 'AppointmentController@index');
    Route::post('appointments', 'AppointmentController@store');
    Route::get('appointments/{appointment}', 'AppointmentController@show');
    Route::put('appointments-time/{appointments}', 'AppointmentController@changeTime');

    Route::group(['middleware' => ['owner_appointment:appointment']], function () {
        Route::put('favorite/{appointment}', 'AppointmentController@favorite');
        Route::put('appointments/{appointment}', 'AppointmentController@update');
        Route::get('continue-waiting/{appointment}', 'AppointmentController@waiting');
        Route::get('save-to-later/{appointment}', 'AppointmentController@saveToLater');
    });

    Route::get('history-client', 'AppointmentController@historyClient');


    Route::get('categories', 'CategoryController@index');

    Route::get('statuses', 'StatusController@index');

    Route::get('favorites', 'AppointmentController@favorites');


});
