<?php

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('verified');;

/**
 * Account
 */
Route::group(['prefix' => 'account', 'middleware' => ['auth'], 'as' => 'account.'], function() {
    Route::get('/', 'Account\AccountController@index')->name('index');
    /**
     * Profile
     */
    Route::get('/profile', 'Account\ProfileController@index')->name('profile.index');
    Route::post('/profile', 'Account\ProfileController@store')->name('profile.store');
    /**
     * Password
     */
    Route::get('/password', 'Account\PasswordController@index')->name('password.index');
    Route::post('/password', 'Account\PasswordController@store')->name('password.store');
});


Route::group(['prefix' => 'plans', 'as' => 'plans.'], function() {
    Route::get('/', 'Subscription\PlanController@index')->name('index');
    Route::get('/teams', 'Subscription\PlanTeamController@index')->name('teams.index');
});
