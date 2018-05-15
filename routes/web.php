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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/my-settings', 'MySettings\SettingsController@index')->name('user-settings')->middleware('auth');
Route::post('/my-settings', 'MySettings\SettingsController@update')->name('user-settings.update')->middleware('auth');

Route::get('/my-settings/password', 'MySettings\PasswordController@index')->name('user-settings.password')->middleware('auth');
Route::post('/my-settings/password', 'MySettings\PasswordController@update')->name('user-settings.password.update')->middleware('auth');

Route::get('/my-settings/photo', 'MySettings\PhotoController@index')->name('user-settings.photo')->middleware('auth');
Route::post('/my-settings/photo', 'MySettings\PhotoController@update')->name('user-settings.photo.update')->middleware('auth');
Route::get('/user/{user}/photo/{size}/{photoFile}', 'MySettings\PhotoController@photo')->name('user.photo')->middleware('auth');

Route::resource('family', 'FamilyController');
Route::get('{family}/photo/{photoFile}', 'FamilyController@photo')->name('family.photo');

Route::namespace('Family')->prefix("{family}")->name('family.')->middleware(VerifyFamilyAccess::class, ConnectFamilyDatabase::class)->group(function() {

    Route::get('/', 'HomeController@index')->name('home');


});
