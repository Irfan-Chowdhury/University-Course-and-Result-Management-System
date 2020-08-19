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

Route::get('/dashboard','Backend\HomeController@index')->name('dashboard');

Route::group(['namespace'=>'Backend'], function () {
        
    Route::group(['prefix' => 'department'], function () {
        Route::get('/','DepartmentController@index')->name('department.index');
        Route::post('/store','DepartmentController@store')->name('department.store');
        Route::get('/edit/{id}','DepartmentController@edit')->name('department.edit');
        Route::post('/update/{id}','DepartmentController@update')->name('department.update');
        Route::get('/delete/{id}','DepartmentController@destroy')->name('department.delete');
    });

    Route::group(['prefix' => 'course'], function () {
        Route::get('/create','CourseController@create')->name('course.create');
        Route::post('/store','CourseController@store')->name('course.store');
    });

    Route::group(['prefix' => 'teacher'], function () {
        Route::get('/create','TeacherController@create')->name('teacher.create');
        Route::post('/store','TeacherController@store')->name('teacher.store');
    });

    Route::group(['prefix' => 'course_assign_to_teacher'], function () {
        Route::get('/create','CourseAssignToTeacherController@create')->name('course_assign_to_teacher.create');
        Route::get('/department-wise-teacher-list','CourseAssignToTeacherController@departmentWiseTeacherList')->name('department-wise-teacher-list'); //Ajax
        Route::get('/teacher-wise-credit_and_course-info','CourseAssignToTeacherController@teacherWiseCreditAndCourseInfo')->name('teacher-wise-credit_and_course-info'); //Ajax
        Route::get('/course-name_and_credit-info','CourseAssignToTeacherController@courseNameAndCreditInfo')->name('course-name_and_credit-info'); //Ajax
        
        //this alert not working properly
        // Route::get('/credit-check-for-alert','CourseAssignToTeacherController@creditCheckForAlert')->name('credit-check-for-alert'); //Ajax
        
        Route::post('/store','CourseAssignToTeacherController@store')->name('course_assign_to_teacher.store');
    });

    Route::group(['prefix' => 'view_course_statics'], function () {
        Route::get('/index','ViewCourseStaticsController@index')->name('view_course_statics.index');
        Route::get('/show','ViewCourseStaticsController@show')->name('view_course_statics.show');
    });

    Route::group(['prefix' => 'student'], function () {
        Route::get('/create','StudentController@index')->name('student.create');
        Route::post('/store','StudentController@store')->name('student.store');
    });

});