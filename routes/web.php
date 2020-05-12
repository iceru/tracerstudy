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

Route::get('/fakultas', 'FakultasController@create')->name('fakultas.create');
Route::post('/fakultas/store','FakultasController@store')->name('fakultas.store');
Route::get('/fakultas/edit/{id}','FakultasController@edit')->name('fakultas.edit');
Route::patch('/fakultas/update/{id}','FakultasController@update')->name('fakultas.update');
Route::get('/fakultas/delete/{id}','FakultasController@destroy')->name('fakultas.destroy');

Route::get('/prodi', 'ProdiController@create')->name('prodi.create');
Route::post('/prodi/store','ProdiController@store')->name('prodi.store');
Route::get('/prodi/edit/{id}','ProdiController@edit')->name('prodi.edit');
Route::patch('/prodi/update/{id}','ProdiController@update')->name('prodi.update');
Route::get('/prodi/delete/{id}','ProdiController@destroy')->name('prodi.destroy');

Route::get('/mahasiswa', 'MahasiswaController@create')->name('mahasiswa.create');
Route::post('/mahasiswa/store','MahasiswaController@store')->name('mahasiswa.store');
Route::post('/mahasiswa/store/alumni','MahasiswaController@storealumni')->name('mahasiswa.storealumni');
Route::post('/mahasiswa/import','MahasiswaController@import')->name('mahasiswa.import');
Route::get('/mahasiswa/export','MahasiswaController@export')->name('mahasiswa.export');
Route::get('/mahasiswa/edit/{id}','MahasiswaController@edit')->name('mahasiswa.edit');
Route::patch('/mahasiswa/update/{id}','MahasiswaController@update')->name('mahasiswa.update');
Route::get('/mahasiswa/delete/{id}','MahasiswaController@destroy')->name('mahasiswa.destroy');

Route::get('/sektor', 'SektorController@create')->name('sektor.create');
Route::post('/sektor/store','SektorController@store')->name('sektor.store');
Route::get('/sektor/edit/{id}','SektorController@edit')->name('sektor.edit');
Route::patch('/sektor/update/{id}','SektorController@update')->name('sektor.update');
Route::get('/sektor/delete/{id}','SektorController@destroy')->name('sektor.destroy');

Route::get('/perusahaan', 'PerusahaanController@create')->name('perusahaan.create');
Route::post('/perusahaan/store','PerusahaanController@store')->name('perusahaan.store');
Route::post('/perusahaan/store/alumni','PerusahaanController@storealumni')->name('perusahaan.storealumni');
Route::get('/perusahaan/edit/{id}','PerusahaanController@edit')->name('perusahaan.edit');
Route::patch('/perusahaan/update/{id}','PerusahaanController@update')->name('perusahaan.update');
Route::get('/perusahaan/delete/{id}','PerusahaanController@destroy')->name('perusahaan.destroy');

Route::get('/jabatan', 'JabatanController@create')->name('jabatan.create');
Route::post('/jabatan/store','JabatanController@store')->name('jabatan.store');
Route::post('/jabatan/store/alumni','JabatanController@storealumni')->name('jabatan.storealumni');
Route::get('/jabatan/edit/{id}','JabatanController@edit')->name('jabatan.edit');
Route::patch('/jabatan/update/{id}','JabatanController@update')->name('jabatan.update');
Route::get('/jabatan/delete/{id}','JabatanController@destroy')->name('jabatan.destroy');

Route::get('/admin/alumni', 'AlumniController@index')->name('alumni.index');
Route::post('/admin/alumni/store','AlumniController@storeadmin')->name('alumni.storeadmin');
Route::get('/admin/alumni/edit/{id}', 'AlumniController@edit')->name('alumni.edit');
Route::post('/admin/alumni/import','AlumniController@import')->name('alumni.import');
Route::get('/admin/alumni/export','AlumniController@export')->name('alumni.export');
Route::patch('/admin/alumni/update/{id}','AlumniController@update')->name('alumni.update');
Route::get('/admin/alumni/delete/{id}','AlumniController@destroy')->name('alumni.destroy');

Route::get('/alumni', 'AlumniController@create')->name('alumni.create');
Route::post('/alumni/store/{id}','AlumniController@store')->name('alumni.store');

Route::get('/pekerjaan/{id}','HistoryPekerjaanController@index')->name('historypekerjaan.index');
Route::post('/pekerjaan/store/{id}','HistoryPekerjaanController@store')->name('historypekerjaan.store');

Route::get('/kuesioner','KuesionerController@index')->name('kuesioner.index');
Route::get('/kuesioner/{id}','KuesionerController@show')->name('kuesioner.show');
Route::post('/kuesioner/{id}','KuesionerController@store')->name('kuesioner.store');

Route::get('/opsi-pertanyaan', 'OpsiController@create')->name('opsi.create');
Route::post('/opsi-pertanyaan/store','OpsiController@store')->name('opsi.store');
Route::get('/opsi-pertanyaan/edit/{id}','OpsiController@edit')->name('opsi.edit');
Route::patch('/opsi-pertanyaan/update/{id}','OpsiController@update')->name('opsi.update');
Route::get('/opsi-pertanyaan/delete/{id}','OpsiController@destroy')->name('opsi.destroy');

Route::get('/pertanyaan', 'PertanyaanController@create')->name('pertanyaan.create');
Route::post('/pertanyaan/store','PertanyaanController@store')->name('pertanyaan.store');
Route::get('/pertanyaan/edit/{id}','PertanyaanController@edit')->name('pertanyaan.edit');
Route::patch('/pertanyaan/update/{id}','PertanyaanController@update')->name('pertanyaan.update');
Route::get('/pertanyaan/delete/{id}','PertanyaanController@destroy')->name('pertanyaan.destroy');



