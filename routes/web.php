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

});