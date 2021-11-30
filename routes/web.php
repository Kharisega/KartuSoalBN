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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//! Route khusus untuk Admin
Route::middleware('role:admin')->resource('guru', 'GuruController');    
Route::middleware('role:admin')->resource('kelas', 'KelasController');    
Route::middleware('role:admin')->resource('jurusan', 'JurusanController');    
Route::middleware('role:admin')->resource('mapel', 'MapelController');
Route::middleware('role:admin')->resource('kognitif', 'KognitifController');

//! Route khusus untuk Guru
Route::middleware('role:guru')->resource('kartu', 'KartuController');

Route::get('/kode', 'KodeController@index')->name('kode.index');
Route::post('/kode/import_excel', 'KodeController@import_excel');
