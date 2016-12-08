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
use App\Mail\UserPass;

Route::group(['middleware' => 'notuser'], function () {
    // login
    Route::get('/', 'LoginController@getLogin')->name('getLoginR');
    Route::get('login', 'LoginController@getLogin')->name('getLogin');
    Route::post('login', 'LoginController@postLogin')->name('postLogin');

    //Password reset route
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');;
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
});

Route::get('logout', 'LoginController@getLogout')->name('getLogout');

Route::group(['middleware' => 'student'], function () {
    Route::group(['prefix' => 'student'], function() {
        Route::get('/', function () {
            return view('student.dashboard');
        });
        Route::get('topicRegister','Student\TopicController@getViewRegister')->name('topicRegister');
        Route::post('postTopicStudent','Student\TopicController@postTopicStudent')->name('postTopicStudent');
        Route::get('listRegister','Student\TopicController@listRegister')->name('listRegister');
        Route::get('cancelRegister/{id}','Student\TopicController@cancelRegister')->name('cancelRegister');
        Route::get('editRegister/{id}','Student\TopicController@editRegister')->name('editRegister');
    });
});

Route::group(['middleware' => 'instructor'], function () {
    Route::group(['prefix' => 'instructor'], function() {
        Route::get('/', function () {
            return view('instructor.dashboard');
        });
        Route::get('profile', 'Instructor\InstructorController@getInstructorEdit')->name('getInstructorEdit');
        Route::post('profile', 'Instructor\InstructorController@postInstructorEdit')->name('postInstructorEdit');
        Route::get('change-password', 'Auth\ChangePasswordController@getInstructorPasswordChange')->name('getInstructorPasswordChange');
        Route::post('change-password', 'Auth\ChangePasswordController@postInstructorPasswordChange')->name('postInstructorPasswordChange');
    });
});

Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'admin'],function() {
        Route::get('/',function () {
            return view('admin.dashboard');
        });
        Route::group(['prefix' => 'instructor'],function() {
            Route::get('/', 'Admin\InstructorController@getInstructorList')->name('getInstructorList');
            Route::get('add', 'Admin\InstructorController@getInstructorAdd')->name('getInstructorAdd');
            Route::post('add', 'Admin\InstructorController@postInstructorAdd')->name('postInstructorAdd');
            // for ajax
            Route::post('faculty', 'Admin\InstructorController@postUnitByFaculty')->name('postUnitByFaculty');

        });
        Route::group(['prefix' => 'topic'],function(){
            Route::get('add','Admin\TopicController@getStudentCanAdd')->name('getStudentCanAdd');
            Route::post('add','Admin\TopicController@postStudentCanAdd')->name('postStudentCanAdd');
            Route::get('mailStudentCan','Admin\TopicController@sendMailStudentCan')->name('sendMailStudentCan');
            Route::get('managerRegister','Admin\TopicController@managerRegister')->name('managerRegister');
            Route::get('turnOnRegister','Admin\TopicController@turnOnRegister')->name('turnOnRegister');
            Route::get('turnOffRegister','Admin\TopicController@turnOffRegister')->name('turnOffRegister');
            Route::get('registerTopic','Admin\TopicController@topicRegister')->name('registerTopic');
            Route::post('postTopic','Admin\TopicController@postTopic')->name('postTopic');
            Route::get('withDrawTopic','Admin\TopicController@withDrawTopic')->name('withDrawTopic');

            Route::post('id-check', 'Admin\InstructorController@postIdCheck')->name('postIdCheck');
            Route::post('api/instructors', 'Admin\InstructorController@apiInstructor')->name('apiInstructor');
        });

        Route::group(['prefix' => 'student'],function() {
            Route::get('add', 'Admin\StudentController@getStudentAdd')->name('getStudentAdd');
            Route::post('add', 'Admin\StudentController@postStudentAdd')->name('postStudentAdd');
        });

        Route::group(['prefix' => 'record'],function(){
            Route::get('receiveRecordMark','Admin\RecordController@receiveRecordMark')->name('receiveRecordMark');
            Route::get('managerRecordTopic','Admin\RecordController@managerRecordTopic')->name('managerRecordTopic');
            Route::get('turnOnRecordRegister','Admin\RecordController@turnOnRecordRegister')->name('turnOnRecordRegister');
            Route::get('turnOffRecordRegister','Admin\RecordController@turnOffRecordRegister')->name('turnOffRecordRegister');
            Route::get('checkValidRecord','Admin\RecordController@checkValidRecord')->name('checkValidRecord');
            Route::get('export_RecordValidList','Admin\RecordController@export_RecordValidList')->name('export_RecordValidList');
            Route::get('sendMailStudentHasTopic','Admin\RecordController@sendMailStudentHasTopic')->name('sendMailStudentHasTopic');
        });


        Route::group(['prefix' => 'defend'],function(){
            Route::get('assignReview','Admin\DefendController@assignReview')->name('assignReview');
            Route::get('makeCouncil','Admin\DefendController@makeCouncil')->name('makeCouncil');
            Route::get('exportEnd','Admin\DefendController@exportEnd')->name('exportEnd');
            Route::get('assignReview_export','Admin\DefendController@assignReview_export')->name('assignReview_export');
            Route::get('makeCouncil_export','Admin\DefendController@makeCouncil_export')->name('makeCouncil_export');
            Route::get('docSuggest_export','Admin\DefendController@docSuggest_export')->name('docSuggest_export');
        });
        
    });
});
