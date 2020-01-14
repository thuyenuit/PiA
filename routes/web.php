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

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('languages/{locale}', 'HomeController@changeLocalization')->name('language');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('home', 'HomeController@index')->name('home');

    // Members management
    Route::resource('members', 'MembersController');
    Route::get('my-profile', 'MembersController@profile')->name('my_profile');
    Route::post('my-profile', 'MembersController@updateProfile')->name('my_profile');
    Route::post('update-avatar', 'MembersController@updateAvatar')->name('update_avatar');
    
    // Clubs management
    Route::resource('clubs', 'ClubsController');

    // Payments management
    Route::resource('payments', 'PaymentsController');

    // Ratings
    Route::resource('ratings', 'RatingsController');

    // Statistics
    Route::get('statistics/club', 'StatisticsController@club')->name('statistics.club');
    Route::get('statistics/member', 'StatisticsController@member')->name('statistics.member');
    Route::get('statistics/payment', 'StatisticsController@payment')->name('statistics.payment');

    // Field Groups management
    Route::resource('field_groups', 'FieldGroupsController');
    
    // Fields management
    Route::resource('fields', 'FieldsController');
    Route::post('fields/{id}/mandatory', 'FieldsController@updateMandatory')->name('fields.mandatory');

    // Groups management
    Route::resource('groups', 'GroupsController');
    Route::resource('groups.users', 'GroupsUsersController')->except(['edit', 'update', 'show']);

    // Translations management
    Route::resource('translations', 'TranslationsController');
    Route::post('translations/{id}/locale', 'TranslationsController@updateLocale')->name('translations.locale');
    Route::post('translations/{id}/primary', 'TranslationsController@updatePrimary')->name('translations.primary');

    // App Settings
    Route::get('settings/app', 'SettingsController@index')->name('app_settings');
    Route::post('settings/app', 'SettingsController@updateSiteAssets');
    Route::get('settings/payment', 'SettingsController@payment')->name('payment_methods');
});
