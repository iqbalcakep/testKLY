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

//BY IQBALCAKEP

//LOGIN SECTION
Route::get('/','LoginController@index');
Route::get('/log_out', 'LoginController@logout');
Route::post('/login_proses','LoginController@login_proses');


//CRUD SECTION
Route::group(['middleware' => ['hasLogin']], function () {
    Route::get('/crud', 'CrudController@index');
    Route::get('/getAllData', 'CrudController@getAllData');
    Route::post('/crud/insert_post','CrudController@insert_post');
    Route::post('/crud/update_post','CrudController@update_post');
    Route::post('/crud/delete_post','CrudController@delete_post');
});
