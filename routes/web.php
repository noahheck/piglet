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

Route::resource('family', 'FamilyController');
