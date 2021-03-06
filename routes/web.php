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


Route::get('/', 'HomeController@index')->name('home');

Route::get('/admin/dashboard', 'AdminController@index');

Route::get('/admin/owners', 'AdminController@ownerList');

Route::get('/admin/pets', 'AdminController@petList');

Route::get('/admin/services', 'AdminController@serviceList');

Route::get('/admin/medications', 'AdminController@medicationList');

Route::get('/admin/doctors', 'DoctorController@index');
Route::get('/admin/doctor/schedule/{id}', 'DoctorController@schedules');
Route::post('/admin/doctor/schedule/add', 'DoctorController@saveSchedules');
Route::post('/admin/doctor/schedule/edit', 'DoctorController@editSchedules');
Route::post('/admin/doctor/schedule/change', 'DoctorController@changDate');

Route::get('/admin/appointments', 'AppointmentController@index');

Route::get('/admin/accounts', 'UserController@index');

Route::post('/admin/account/add', 'UserController@save');
Route::post('/admin/account/update', 'UserController@update');
Route::post('/admin/account/delete', 'UserController@delete');

Route::get('/admin/notifications', 'NotificationController@index');

Auth::routes();