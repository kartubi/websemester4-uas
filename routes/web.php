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
    return view('index');
});

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin'],function (){
    Route::any('login','admin\UserController@login');
    Route::group(['middleware' => 'auth:web'],function(){
        Route::get('/{id}','admin\UserController@index');
        Route::get('data/get','admin\UserController@show');
   });
});
Route::group(['prefix'=>'mahasiswa'],function (){
    Route::any('login','mahasiswa\UserController@login');
    Route::group(['middleware' => 'auth:mahasiswa'],function(){
        Route::get('/','mahasiswa\UserController@index');

   });
});

//Route::resource('admin', 'adminController');
//Route::resource('mahasiswa', 'mahasiswaController');
//Route::resource('test', 'nilaiAdminController');
