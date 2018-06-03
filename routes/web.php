<?php

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

use App\Http\Middleware\ConnectFamilyDatabase;
use App\Http\Middleware\VerifyFamilyAccess;

Route::singularResourceParameters();

Route::get('/', function () {
    return view('welcome');
});

// Useful for debugging situations
//Route::get('/{family}/ajax-test', 'Family\HomeController@ajaxTest')->name('test.ajax.get');
//Route::post('/{family}/{name}/ajax-test', 'Family\HomeController@ajaxTest')->name('test.ajax.post');

Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();

Route::middleware('auth')->group(function() {

    Route::get('/verify-email', 'MySettings\EmailController@showVerifyEmail')->name('user-settings.show-verify-email');
    Route::post('/verify-email', 'MySettings\EmailController@verifyEmail')->name('user-settings.verify-email');
    Route::post('/request-email-verification', 'MySettings\EmailController@requestNewPin')->name('user-settings.new-email-pin');


    Route::get('/my-settings', 'MySettings\SettingsController@index')->name('user-settings');
    Route::post('/my-settings', 'MySettings\SettingsController@update')->name('user-settings.update');

    Route::get('/my-settings/password', 'MySettings\PasswordController@index')->name('user-settings.password');
    Route::post('/my-settings/password', 'MySettings\PasswordController@update')->name('user-settings.password.update');

    Route::get('/my-settings/photo', 'MySettings\PhotoController@index')->name('user-settings.photo');
    Route::post('/my-settings/photo', 'MySettings\PhotoController@update')->name('user-settings.photo.update');
    Route::get('/user/{user}/photo/{size}/{photoFile}', 'MySettings\PhotoController@photo')->name('user.photo');
});



Route::middleware('auth', 'auth.email_verified')->group(function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('family', 'FamilyController');
    Route::get('{family}/photo/{size}/{photoFile}', 'FamilyController@photo')->name('family.photo');

    Route::namespace('Family')->prefix("{family}")->name('family.')->middleware(VerifyFamilyAccess::class, ConnectFamilyDatabase::class)->group(function() {

        Route::get('/', 'HomeController@index')->name('home');

    //    Route::get('/emailTest', 'HomeController@emailTest')->name('email-test');


        // Family Members
        Route::resource('/members', 'MemberController');
        Route::get('/members/{member}/photo/{size}/{photoFile}', 'MemberController@photo')->name('member.photo');

        // Tasks
        Route::resource('/taskLists', 'TaskListController');

        Route::prefix('/taskLists/{taskList}')->group(function() {
            Route::resource('/tasks', 'TaskController');
        });


    });
});
