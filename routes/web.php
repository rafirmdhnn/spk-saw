<?php

use App\Http\Controllers\Admin\KriteriaController;
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

Route::get('/', 'BaseController@index')->name('index');
Route::get('/question', 'BaseController@question')->name('question');
Route::post('/question/store', 'BaseController@questionStore')->name('question.store');
Route::get('/result/{id}', 'BaseController@result')->name('result');
Route::get('/detail/{user_id}', 'BaseController@detail')->name('detail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
    Route::resource('user', 'Admin\UserController');
    Route::resource('kriteria', 'Admin\KriteriaController');
    Route::resource('kriteria-nilai', 'Admin\KriteriaNilaiController');
    Route::resource('alternatif', 'Admin\AlternatifController');
    Route::resource('bobot-preferensi', 'Admin\BobotController');
    Route::resource('atribut-kriteria', 'Admin\AtributKriteriaController');
    Route::resource('bai-konten', 'Admin\BaiKontenController');
    Route::resource('perhitungan', 'Admin\PerhitunganController');
    Route::put('kriteria/update-kriteria/{id}', 'Admin\KriteriaController@update')->name('kriteria.update');
    Route::get('perhitungan/detail/{user_id}', 'Admin\PerhitunganController@detail')->name('perhitungan.detail');
    Route::get('perhitungan/pdf/{user_id}', 'Admin\PerhitunganController@pdf')->name('perhitungan.pdf');
});