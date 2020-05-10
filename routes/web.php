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
    return view('home-admin');
});

Route::get('/fakultas', 'FakultasController@index')->name('fakultas.index');
Route::post('/fakultas/store','FakultasController@store')->name('fakultas.store');
Route::get('/fakultas/edit/{id}','FakultasController@edit')->name('fakultas.edit');
Route::patch('/fakultas/update/{id}','FakultasController@update')->name('fakultas.update');
Route::get('/fakultas/delete/{id}','FakultasController@destroy')->name('fakultas.destroy');

Route::get('/prodi', 'ProdiController@index')->name('prodi.index');
Route::post('/prodi/store','ProdiController@store')->name('prodi.store');
Route::get('/prodi/edit/{id}','ProdiController@edit')->name('prodi.edit');
Route::patch('/prodi/update/{id}','ProdiController@update')->name('prodi.update');
Route::get('/prodi/delete/{id}','ProdiController@destroy')->name('prodi.destroy');

Route::get('/mahasiswa', 'MahasiswaController@index')->name('mahasiswa.index');
Route::post('/mahasiswa/store','MahasiswaController@store')->name('mahasiswa.store');
Route::get('/mahasiswa/edit/{id}','MahasiswaController@edit')->name('mahasiswa.edit');
Route::patch('/mahasiswa/update/{id}','MahasiswaController@update')->name('mahasiswa.update');
Route::get('/mahasiswa/delete/{id}','MahasiswaController@destroy')->name('mahasiswa.destroy');

Route::get('/sektor', 'SektorController@index')->name('sektor.index');
Route::post('/sektor/store','SektorController@store')->name('sektor.store');
Route::get('/sektor/edit/{id}','SektorController@edit')->name('sektor.edit');
Route::patch('/sektor/update/{id}','SektorController@update')->name('sektor.update');
Route::get('/sektor/delete/{id}','SektorController@destroy')->name('sektor.destroy');

Route::get('/perusahaan', 'PerusahaanController@index')->name('perusahaan.index');
Route::post('/perusahaan/store','PerusahaanController@store')->name('perusahaan.store');
Route::get('/perusahaan/edit/{id}','PerusahaanController@edit')->name('perusahaan.edit');
Route::patch('/perusahaan/update/{id}','PerusahaanController@update')->name('perusahaan.update');
Route::get('/perusahaan/delete/{id}','PerusahaanController@destroy')->name('perusahaan.destroy');

Route::get('/jabatan', 'JabatanController@index')->name('jabatan.index');
Route::post('/jabatan/store','JabatanController@store')->name('jabatan.store');
Route::get('/jabatan/edit/{id}','JabatanController@edit')->name('jabatan.edit');
Route::patch('/jabatan/update/{id}','JabatanController@update')->name('jabatan.update');
Route::get('/jabatan/delete/{id}','JabatanController@destroy')->name('jabatan.destroy');

Route::get('/alumni', 'AlumniController@index')->name('alumni.index');
Route::post('/alumni/store/{id}','AlumniController@store')->name('alumni.store');

Route::get('/pekerjaan/{id}','HistoryPekerjaanController@index')->name('historypekerjaan.index');
Route::post('/pekerjaan/store/{id}','HistoryPekerjaanController@store')->name('historypekerjaan.store');

Route::get('/kuesioner/{id}','KuesionerController@index')->name('kuesioner.index');

Route::get('/opsi-pertanyaan', 'OpsiController@index')->name('opsi.index');
Route::post('/opsi-pertanyaan/store','OpsiController@store')->name('opsi.store');
Route::get('/opsi-pertanyaan/edit/{id}','OpsiController@edit')->name('opsi.edit');
Route::patch('/opsi-pertanyaan/update/{id}','OpsiController@update')->name('opsi.update');
Route::get('/opsi-pertanyaan/delete/{id}','OpsiController@destroy')->name('opsi.destroy');

Route::get('/pertanyaan', 'PertanyaanController@index')->name('pertanyaan.index');
Route::post('/pertanyaan/store','PertanyaanController@store')->name('pertanyaan.store');
Route::get('/pertanyaan/edit/{id}','PertanyaanController@edit')->name('pertanyaan.edit');
Route::patch('/pertanyaan/update/{id}','PertanyaanController@update')->name('pertanyaan.update');
Route::get('/pertanyaan/delete/{id}','PertanyaanController@destroy')->name('pertanyaan.destroy');



