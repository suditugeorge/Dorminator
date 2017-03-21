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

Route::get('/', [
    'as' => 'home',
    'uses' => 'MainController@home',
]);

Route::post('/login', [
    'as' => 'login',
    'uses' => 'MainController@login',
]);

Route::get('/add-admin-user/{email}', [
    'uses' => 'UserController@createAdminInterface',
]);
Route::get('/logout', [
    'uses' => 'MainController@logout',
]);

Route::post('/admin-sign-up', [
    'uses' => 'UserController@adminSignUp',
]);

//For these routes all the users must be logged in
Route::group(['middleware' => 'isLogedIn'], function () {

    Route::get('/dashboard', [
        'uses' => 'UserController@dashboard',
        'as' => 'dashboard',
    ]);
    
    Route::post('/change-profile-photo', [
        'uses' => 'UserController@changeProfilePhoto',
    ]);

    //For these routes all the users must have a status of Admin or Super Admin
    Route::group(['middleware' => 'isAdmin'], function () {

        Route::post('/change-user-profile', [
            'uses' => 'UserController@updateProfile',
        ]);

        Route::get('/users', [
            'as' => 'users-admin',
            'uses' => 'UserController@adminGetUsers',
        ]);

        Route::post('/add-admins', [
            'uses' => 'UserController@addAdmins',
        ]);

    });

    //For these routes the loged in user must be Super Admin
    Route::group(['middleware' => 'isSuperAdmin'], function () {

        Route::get('/email-preview/admin-confrimation/{email}', [
            'uses' => 'EmailPreview@adminConfrimation',
        ]);

    });

});

