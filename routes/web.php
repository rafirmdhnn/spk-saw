<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
    Route::resource('user', 'Admin\UserController');
    Route::resource('kriteria', 'Admin\KriteriaController');
    Route::resource('kriteria-nilai', 'Admin\KriteriaNilaiController');
    Route::resource('alternatif', 'Admin\AlternatifController');
    Route::resource('alternatif-nilai', 'Admin\AlternatifNilaiController');
    Route::get('perhitungan', 'Admin\PerhitunganController@index')->name('perhitungan.index');

    Route::get('perhitungan/pdf', 'Admin\PerhitunganController@pdf')->name('perhitungan.pdf');
});