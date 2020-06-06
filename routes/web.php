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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('home-admin');
    });

    Route::resource('fakultas', 'FakultasController');
    Route::resource('prodi', 'ProdiController');
    Route::resource('mahasiswa', 'MahasiswaController');
    Route::resource('sektor', 'SektorController');
    Route::resource('perusahaan', 'PerusahaanController');
    Route::resource('jabatan', 'JabatanController');

    Route::resource('roles','RoleController');
    Route::resource('users','UserController');

    Route::post('/mahasiswa/import','MahasiswaController@import')->name('mahasiswa.import');
    Route::get('/mahasiswa/export','MahasiswaController@export')->name('mahasiswa.export');

    Route::get('/admin/alumni', 'AlumniController@index')->name('alumni.index');
    Route::get('/admin/alumni/create', 'AlumniController@input')->name('alumni.input');
    Route::post('/admin/alumni/store','AlumniController@storeadmin')->name('alumni.storeadmin');
    Route::get('/admin/alumni/edit/{id}', 'AlumniController@edit')->name('alumni.edit');
    Route::post('/admin/alumni/import','AlumniController@import')->name('alumni.import');
    Route::get('/admin/alumni/export','AlumniController@export')->name('alumni.export');
    Route::patch('/admin/alumni/update/{id}','AlumniController@update')->name('alumni.update');
    Route::get('/admin/alumni/delete/{id}','AlumniController@destroy')->name('alumni.destroy');

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

    Route::get('/laporan/jarak', 'LaporanController@haversine')->name('jarak.haversine');
    Route::get('/laporan/jarak/detail/{id}', 'LaporanController@showJarak')->name('laporan.showJarak');

    Route::get('/laporan/jabatan', 'LaporanController@jabatan')->name('laporan.jabatan');

    Route::get('/chart/jabatan', 'LaporanController@indexChartJabatan')->name('laporan.indexChartJabatan');
    Route::get('/chart-jabatan', 'LaporanController@chartJabatan')->name('laporan.chartJabatan');
    Route::get('/chart/jabatan/detail/{id}', 'LaporanController@showJabatan')->name('laporan.showJabatan');

    Route::get('/chart/perusahaan', 'LaporanController@indexChartPerusahaan')->name('laporan.indexChartPerusahaan');
    Route::get('/chart-perusahaan', 'LaporanController@chartPerusahaan')->name('laporan.chartPerusahaan');
    Route::get('/chart/perusahaan/detail/{id}', 'LaporanController@showPerusahaan')->name('laporan.showPerusahaan');

    Route::get('/laporan/hasil-kuesioner', 'KuesionerController@hasil')->name('kuesioner.hasil');

});


Route::post('/jabatan/store/alumni','JabatanController@storealumni')->name('jabatan.storealumni');

Route::get('/tracer-study/alumni', 'AlumniController@create')->name('alumni.create');
Route::post('/tracer-study/alumni/store/{id}','AlumniController@store')->name('alumni.store');
Route::post('/mahasiswa/store/alumni','MahasiswaController@storealumni')->name('mahasiswa.storealumni');

Route::get('/tracer-study/pekerjaan/{id}','HistoryPekerjaanController@index')->name('historypekerjaan.index');
Route::post('/tracer-study/pekerjaan/store/{id}','HistoryPekerjaanController@store')->name('historypekerjaan.store');
Route::post('/perusahaan/store/alumni','PerusahaanController@storealumni')->name('perusahaan.storealumni');

Route::get('/kuesioner','KuesionerController@index')->name('kuesioner.index');
Route::get('/kuesioner/{id}','KuesionerController@show')->name('kuesioner.show');
Route::post('/kuesioner','KuesionerController@store')->name('kuesioner.store');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/roles','RoleController@index')->name('roles.index');

// Route::group(['middleware' => ['auth']], function() {

// });
