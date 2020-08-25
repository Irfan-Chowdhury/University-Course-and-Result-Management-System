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

    Route::group(['prefix' => 'allocate_classroom'], function () {
        Route::get('/create','AllocateClassroomController@index')->name('allocate_classroom.create');
        Route::post('/store','AllocateClassroomController@store')->name('allocate_classroom.store');
    });

    Route::group(['prefix' => 'enroll_in_course'], function () {
        Route::get('/create','EnrollInCourseController@create')->name('enroll_in_course.create');
        Route::get('/student-wise-info','EnrollInCourseController@studentWiseInfo')->name('student-wise-info');
        Route::post('/store','EnrollInCourseController@store')->name('enroll_in_course.store');
    });

    Route::group(['prefix' => 'result'], function () {
        Route::get('/create','ResultController@create')->name('result.create');
        Route::get('/create/{id}','ResultController@show')->name('data_by_student.show');
        Route::post('/store','ResultController@store')->name('result.store');
    });

    Route::group(['prefix' => 'view_result'], function () {
        Route::get('/index','ViewResultController@index')->name('view_result.index');
        Route::get('/show/{id}','ViewResultController@show')->name('view_result.show');
    });

    Route::group(['prefix' => 'unassgin_courses'], function () {
        Route::get('/create','UnassignAllCourses@create')->name('unassgin_courses.create');
        Route::post('/unassign_course','UnassignAllCourses@unassign_course')->name('unassign_course');
    });
});