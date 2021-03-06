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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \Spatie\Honeypot\ProtectAgainstSpam;

Route::singularResourceParameters();

Route::middleware(ProtectAgainstSpam::class)->group(function() {

    Auth::routes();

});

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/'       , 'MarketingController@home')->name('homepage');
Route::get('/project', 'MarketingController@project')->name('project');
Route::get('/pricing', 'MarketingController@pricing')->name('pricing');

Route::get('/terms-of-use', 'LegalController@terms')->name('terms-of-use');
Route::get('/privacy'     , 'LegalController@privacy')->name('privacy');


Route::get('/help/{key?}', 'HelpController@help')->name('help');


Route::middleware('auth')->group(function() {

    Route::get('/verify-email', 'MySettings\EmailController@showVerifyEmail')->name('user-settings.show-verify-email');
    Route::post('/verify-email', 'MySettings\EmailController@verifyEmail')->name('user-settings.verify-email');
    Route::post('/request-email-verification', 'MySettings\EmailController@requestNewPin')->name('user-settings.new-email-pin');

    Route::post('/invitation/{invitation}/accept', 'InvitationController@accept')->name('invitation.accept');

    Route::get('/my-settings', 'MySettings\SettingsController@index')->name('user-settings');
    Route::post('/my-settings', 'MySettings\SettingsController@update')->name('user-settings.update');

    Route::get('/my-settings/password', 'MySettings\PasswordController@index')->name('user-settings.password');
    Route::post('/my-settings/password', 'MySettings\PasswordController@update')->name('user-settings.password.update');

    Route::get('/my-settings/photo', 'MySettings\PhotoController@index')->name('user-settings.photo');
    Route::post('/my-settings/photo', 'MySettings\PhotoController@update')->name('user-settings.photo.update');
    Route::get('/user/{user}/photo/{size}/{photoFile}', 'MySettings\PhotoController@photo')->name('user.photo');
});



Route::middleware(['auth', 'auth.email_verified', 'auth.is_admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/', 'AdminController@index')->name('home');

    Route::get('/users', 'AdminController@users')->name('users');
    Route::delete('/users/{user}', 'AdminController@deleteUser')->name('user.delete');

    Route::get('/families', 'AdminController@families')->name('families');

    Route::get('/support', 'AdminController@support')->name('support');
});



Route::middleware(['auth', 'auth.email_verified'])->group(function() {

    Route::get('/welcome', 'WelcomeController@index')->name('welcome');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/families', 'HomeController@families')->name('allFamilies');

    Route::resource('family', 'FamilyController');
    Route::get('{family}/photo/{size}/{photoFile}', 'FamilyController@photo')->name('family.photo');

    Route::post('{family}/enableSupportAccess', 'FamilyController@enableSupportAccess')->name('family.enableSupportAccess');
    Route::post('{family}/disableSupportAccess', 'FamilyController@disableSupportAccess')->name('family.disableSupportAccess');


    Route::namespace('Family')->prefix("{family}")->name('family.')->middleware([VerifyFamilyAccess::class, ConnectFamilyDatabase::class])->group(function() {

        Route::get('/archive', 'FamilyController@archive')->name('archive');
        Route::post('/archive', 'FamilyController@archiveNow');
        Route::post('/unarchive', 'FamilyController@unarchive')->name('unarchive');

        Route::get('/', 'HomeController@index')->name('home');

        // Route::get('/emailTest', 'HomeController@emailTest')->name('email-test');


        // Family Members
        Route::resource('/members', 'MemberController');
        Route::get('/members/{member}/photo/{size}/{photoFile}', 'MemberController@photo')->name('member.photo');



        // Tasks
        // This early implementation of tasks is not exposed at this time
        if (\App::isLocal()) {

            Route::resource('/taskLists', 'TaskListController');

            Route::prefix('/taskLists/{taskList}')->group(function() {

                Route::post('/archive', 'TaskListController@archive')->name('taskList.archive');
                Route::post('/restore', 'TaskListController@restore')->name('taskList.restore');

                Route::resource('/tasks', 'TaskController');
            });

        }


        // Calendar
        Route::get('/calendar/{year?}/{month?}/{day?}', 'CalendarController@month')->name('calendar');
        Route::resource('/events', 'EventController');

        // Todos
        Route::resource('/todos', 'TodoController');
        Route::post('/todos/{todo}/complete', 'TodoController@complete')->name('todos.complete');
        Route::post('/todos/{todo}/uncomplete', 'TodoController@uncomplete')->name('todos.uncomplete');

        // Contacts
        Route::resource('/contacts', 'ContactController');

        // Money Matters
        Route::get('/money-matters', 'MoneyMattersController@index')->name('money-matters');

        Route::get('/money-matters/settings', 'MoneyMattersController@settingsView')->name('money-matters.settings');
        Route::post('/money-matters/settings', 'MoneyMattersController@settingsSave')->name('money-matters.settings-save');

        Route::get('/money-matters/welcome', 'MoneyMattersWelcomeController@index')->name('money-matters-welcome');
        Route::post('/money-matters/welcome', 'MoneyMattersWelcomeController@assemble')->name('money-matters-welcome-assemble');


        Route::resource('/merchants', 'MerchantController');

        Route::resource('/piggy-banks', 'PiggyBankController');

        Route::resource('/categories', 'CategoryController');
        Route::post('/categories/update-order', 'CategoryController@updateOrder')->name('categories.update-order');

        Route::resource('/income-sources', 'IncomeSourceController');

        Route::resource('/recurring-expenses', 'RecurringExpenseController');

        Route::resource('/expense-groups', 'ExpenseGroupController');

        Route::resource('/cash-flow-plans', 'CashFlowPlanController');
        Route::get('/cash-flow-plans/create/{year}/{month}', 'CashFlowPlanController@createPlan')->name('cash-flow-plans.create-plan');
        Route::post('/cash-flow-plans/create/{year}/{month}', 'CashFlowPlanController@storePlan')->name('cash-flow-plans.store-plan');

        Route::prefix('/cash-flow-plans/{cashFlowPlan}')->name('cash-flow-plans.')->group(function() {

            Route::get('/print', 'CashFlowPlanController@print')->name('print');


            Route::get('/lifestyle-expenses', 'CashFlowPlanController@lifestyleExpensesView')->name('lifestyle-expenses');
            Route::post('/lifestyle-expenses', 'CashFlowPlanController@lifestyleExpensesSave')->name('lifestyle-expenses-update');

            Route::namespace('CashFlowPlan')->group(function() {

                Route::resource('/income-sources', 'IncomeSourceController');
                Route::resource('/piggy-banks', 'PiggyBankController');
                Route::resource('/piggy-bank-contributions', 'PiggyBankContributionController');
                Route::resource('/recurring-expenses', 'RecurringExpenseController');
                Route::resource('/expense-groups', 'ExpenseGroupController');
                Route::resource('/expenses', 'ExpenseController');

            });
        });


    });
});
