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

Auth::routes();