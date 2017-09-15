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


//For changing passwords and email that are temporary
Route::group(['middleware' => 'isLogedIn'], function () {
    Route::match(['get', 'post'], '/change-password', [
        'uses' => 'UserController@changePasswordTemplate',
        'as' => 'change-password',
    ]);
    Route::match(['get', 'post'], '/change-email', [
        'uses' => 'UserController@changeEmailTemplate',
        'as' => 'change-email',
    ]);
});
//For these routes all the users must be logged in
Route::group(['middleware' => 'isLogedIn'], function () {

    Route::group(['middleware' => 'CheckHasTempPass'], function () {

        Route::group(['middleware' => 'CheckHasTempEmail'], function () {

            Route::get('/profile', [
                'uses' => 'UserController@dashboard',
                'as' => 'dashboard',
            ]);

            Route::post('/change-profile-photo', [
                'uses' => 'UserController@changeProfilePhoto',
            ]);

            Route::get('/messages', [
                'uses' => 'MessageController@messagesTemplate',
            ]);

            Route::match(['get', 'post'], '/new-message', [
                'uses' => 'MessageController@newMessage'
            ]);

            Route::get('/messages/{id}', [
                'uses' => 'MessageController@messageViewTemplate',
            ]);

            Route::get('/delete-message/{id}', [
                'uses' => 'MessageController@deleteMessage',
            ]);

            Route::match(['get', 'post'], '/select-dorm', [
                'uses' => 'DormsController@selectDorm'
            ]);
            Route::post('/change-user-profile', [
                'uses' => 'UserController@updateProfile',
            ]);

            //For these routes all the users must have a status of Admin or Super Admin
            Route::group(['middleware' => 'isAdmin'], function () {

                Route::get('/users', [
                    'as' => 'users-admin',
                    'uses' => 'UserController@adminGetUsers',
                ]);

                Route::match(['get', 'post'], '/add-institution', [
                    'uses' => 'InstitutionController@addInstitution'
                ]);
                Route::match(['get', 'post'], '/dorms', [
                    'uses' => 'DormsController@getDormsTemplate'
                ]);

                Route::get('/delete-institution/{id}', [
                    'uses' => 'InstitutionController@deleteInstitution',
                ]);
                Route::match(['get', 'post'], '/add-students', [
                    'uses' => 'UserController@addStudentsTemplate'
                ]);
                Route::post('/add-admins', [
                    'uses' => 'UserController@addAdmins',
                ]);
                Route::post('/upload-students', [
                    'uses' => 'StudentsController@uploadStudentsFile',
                ]);
                Route::post('/upload-rooms', [
                    'uses' => 'DormsController@uploadRoomsFile',
                ]);

                Route::get('/allocated-dorms', [
                    'uses' => 'DormsController@allocatedDorms',
                ]);

                Route::get('/download-student-template', [
                    'uses' => 'UserController@downloadStudentTemplate',
                ]);

                Route::get('/get-students-pdf', [
                    'uses' => 'StudentsController@getPDF',
                ]);

                Route::post('/start-sort', [
                    'uses' => 'DormsController@startSort',
                ])->middleware(\App\Http\Middleware\StartSorting::class);

                Route::post('/stop-dorminator', [
                    'uses' => 'DormsController@stopDorminator',
                ]);
                Route::post('/start-dorminator', [
                    'uses' => 'DormsController@startDorminator',
                ]);

                Route::post('/algorithm/{algorithm_type}', [
                    'uses' => 'DormsController@selectAlgorithm',
                ]);

            });

            //For these routes the loged in user must be Super Admin
            Route::group(['middleware' => 'isSuperAdmin'], function () {

                Route::get('/email-preview/admin-confrimation/{email}', [
                    'uses' => 'EmailPreview@adminConfrimation',
                ]);

                //TESTING ONLY
                Route::get('/delete-user/{email}', [
                    'uses' => 'UserController@deleteUser',
                ]);
                Route::get('/create-test-message', [
                    'uses' => 'UserController@createTestMessage',
                ]);

            });
        });

    });

});

