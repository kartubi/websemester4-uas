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

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin'],function (){
    Route::any('login','admin\UserController@login')->name('login');
    Route::group(['middleware' => 'auth:web'],function(){
        Route::get('/','admin\UserController@index');

   });
});
Route::group(['prefix'=>'mahasiswa'],function (){
    Route::any('login','mahasiswa\UserController@login')->name('login');
    Route::group(['middleware' => 'auth:mahasiswa'],function(){
        Route::get('/','mahasiswa\UserController@index');

   });
});
