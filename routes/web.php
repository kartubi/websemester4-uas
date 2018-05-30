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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('index');
});

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin'],function (){

    Route::any('login','admin\UserController@login');
    Route::group(['middleware' => 'auth:web'],function(){
        Route::get('/','admin\UserController@index');
        Route::get('data/get_mhs','admin\UserController@show_mhs');
        Route::get('mhs/{id?}','admin\UserController@mhs');
        Route::get('data/get','admin\UserController@show');
        Route::get('data/edit_nilai/{nilai}/{mhs}/{smt}','admin\UserController@edit_nilai');
        Route::post('data/kirim_nilai','admin\UserController@kirim_nilai');
   });
});
Route::group(['prefix'=>'mahasiswa'],function (){
    Route::any('login','mahasiswa\UserController@Login');
    Route::group(['middleware' => 'auth:mahasiswa'],function(){
        Route::get('/','mahasiswa\UserController@mhs');
        Route::get('/data/get','mahasiswa\UserController@show');


   });
});
Route::get('/logout', function()
{
    Auth::logout();
    Session::flush();
    return Redirect::to('/');
});
//Route::resource('admin', 'adminController');
//Route::resource('mahasiswa', 'mahasiswaController');
//Route::resource('test', 'nilaiAdminController');
