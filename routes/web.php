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

    Route::get('/fakultas', 'FakultasController@index')->name('fakultas.index');
    Route::get('/fakultas/create', 'FakultasController@create')->name('fakultas.create');
    Route::post('/fakultas/store','FakultasController@store')->name('fakultas.store');
    Route::get('/fakultas/edit/{id}','FakultasController@edit')->name('fakultas.edit');
    Route::patch('/fakultas/update/{id}','FakultasController@update')->name('fakultas.update');
    Route::get('/fakultas/delete/{id}','FakultasController@destroy')->name('fakultas.destroy');

    Route::get('/prodi', 'ProdiController@index')->name('prodi.index');
    Route::get('/prodi/create', 'ProdiController@create')->name('prodi.create');
    Route::post('/prodi/store','ProdiController@store')->name('prodi.store');
    Route::get('/prodi/edit/{id}','ProdiController@edit')->name('prodi.edit');
    Route::patch('/prodi/update/{id}','ProdiController@update')->name('prodi.update');
    Route::get('/prodi/delete/{id}','ProdiController@destroy')->name('prodi.destroy');

    Route::get('/sektor', 'SektorController@index')->name('sektor.index');
    Route::get('/sektor/create', 'SektorController@create')->name('sektor.create');
    Route::post('/sektor/store','SektorController@store')->name('sektor.store');
    Route::get('/sektor/edit/{id}','SektorController@edit')->name('sektor.edit');
    Route::patch('/sektor/update/{id}','SektorController@update')->name('sektor.update');
    Route::get('/sektor/delete/{id}','SektorController@destroy')->name('sektor.destroy');

    Route::get('/perusahaan', 'PerusahaanController@index')->name('perusahaan.index');
    Route::get('/perusahaan/create', 'PerusahaanController@create')->name('perusahaan.create');
    Route::post('/perusahaan/store','PerusahaanController@store')->name('perusahaan.store');
    Route::get('/perusahaan/edit/{id}','PerusahaanController@edit')->name('perusahaan.edit');
    Route::patch('/perusahaan/update/{id}','PerusahaanController@update')->name('perusahaan.update');
    Route::get('/perusahaan/delete/{id}','PerusahaanController@destroy')->name('perusahaan.destroy');

    Route::get('/jabatan', 'JabatanController@index')->name('jabatan.index');
    Route::get('/jabatan/create', 'JabatanController@create')->name('jabatan.create');
    Route::post('/jabatan/store','JabatanController@store')->name('jabatan.store');
    Route::get('/jabatan/edit/{id}','JabatanController@edit')->name('jabatan.edit');
    Route::patch('/jabatan/update/{id}','JabatanController@update')->name('jabatan.update');
    Route::get('/jabatan/delete/{id}','JabatanController@destroy')->name('jabatan.destroy');

    Route::get('/pekerjaan', 'PekerjaanController@index')->name('pekerjaan.index');
    Route::get('/pekerjaan/create', 'PekerjaanController@create')->name('pekerjaan.create');
    Route::post('/pekerjaan/store','PekerjaanController@store')->name('pekerjaan.store');
    Route::get('/pekerjaan/edit/{id}','PekerjaanController@edit')->name('pekerjaan.edit');
    Route::patch('/pekerjaan/update/{id}','PekerjaanController@update')->name('pekerjaan.update');
    Route::get('/pekerjaan/delete/{id}','PekerjaanController@destroy')->name('pekerjaan.destroy');


    Route::resource('roles','RoleController');
    Route::resource('users','UserController');

    Route::get('/mahasiswa', 'MahasiswaController@index')->name('mahasiswa.index');
    Route::get('/mahasiswa/create', 'MahasiswaController@create')->name('mahasiswa.create');
    Route::post('/mahasiswa/store','MahasiswaController@store')->name('mahasiswa.store');
    Route::get('/mahasiswa/edit/{id}','MahasiswaController@edit')->name('mahasiswa.edit');
    Route::patch('/mahasiswa/update/{id}','MahasiswaController@update')->name('mahasiswa.update');
    Route::get('/mahasiswa/delete/{id}','MahasiswaController@destroy')->name('mahasiswa.destroy');
    Route::post('/mahasiswa/import','MahasiswaController@import')->name('mahasiswa.import');
    Route::get('/mahasiswa/export','MahasiswaController@export')->name('mahasiswa.export');
    ROute::get('/mahasiswa-chart', 'MahasiswaController@chartMhs')->name('mahasiswa.chartMhs');

    Route::get('/admin/alumni', 'AlumniController@index')->name('alumni.index');
    Route::get('/admin/alumni/create', 'AlumniController@input')->name('alumni.input');
    Route::post('/admin/alumni/store','AlumniController@storeadmin')->name('alumni.storeadmin');
    Route::get('/admin/alumni/edit/{id}', 'AlumniController@edit')->name('alumni.edit');
    Route::post('/admin/alumni/import','AlumniController@import')->name('alumni.import');
    Route::get('/admin/alumni/export','AlumniController@export')->name('alumni.export');
    Route::patch('/admin/alumni/update/{id}','AlumniController@update')->name('alumni.update');
    Route::get('/admin/alumni/delete/{id}','AlumniController@destroy')->name('alumni.destroy');
    Route::get('/alumni-chart', 'AlumniController@chartProgramStudi')->name('alumni.chartProgramStudi');

    Route::get('/opsi-pertanyaan', 'OpsiController@create')->name('opsi.create');
    Route::post('/opsi-pertanyaan/store','OpsiController@store')->name('opsi.store');
    Route::get('/opsi-pertanyaan/edit/{id}','OpsiController@edit')->name('opsi.edit');
    Route::patch('/opsi-pertanyaan/update/{id}','OpsiController@update')->name('opsi.update');
    Route::get('/opsi-pertanyaan/delete/{id}','OpsiController@destroy')->name('opsi.destroy');

    Route::get('/opsi-pertanyaan/multiple-answer', 'OpsiController@createMultiple')->name('opsi.createMultiple');
    Route::post('/opsi-pertanyaan/store/multiple-answer','OpsiController@storeMultiple')->name('opsi.storeMultiple');
    Route::get('/opsi-pertanyaan/edit/multiple-answer/{id}','OpsiController@editMultiple')->name('opsi.editMultiple');
    Route::patch('/opsi-pertanyaan/update/multiple-answer/{id}','OpsiController@updateMultiple')->name('opsi.updateMultiple');
    Route::get('/opsi-pertanyaan/delete/multiple-answer/{id}','OpsiController@destroyMultiple')->name('opsi.destroyMultiple');

    Route::get('/pertanyaan/multiple-choice', 'PertanyaanController@create')->name('pertanyaan.create');
    Route::post('/pertanyaan/store','PertanyaanController@store')->name('pertanyaan.store');
    Route::get('/pertanyaan/edit/{id}','PertanyaanController@edit')->name('pertanyaan.edit');
    Route::patch('/pertanyaan/update/{id}','PertanyaanController@update')->name('pertanyaan.update');
    Route::get('/pertanyaan/delete/{id}','PertanyaanController@destroy')->name('pertanyaan.destroy');

    Route::get('/pertanyaan/direct-answer', 'PertanyaanController@createDirect')->name('pertanyaan.createDirect');
    Route::get('/pertanyaan/edit-direct/{id}','PertanyaanController@editDirect')->name('pertanyaan.editDirect');
    Route::post('/pertanyaan/store-direct','PertanyaanController@storeDirect')->name('pertanyaan.storeDirect');
    Route::patch('/pertanyaan/update-direct/{id}','PertanyaanController@updateDirect')->name('pertanyaan.updateDirect');
    Route::get('/pertanyaan/delete-direct/{id}','PertanyaanController@destroyDirect')->name('pertanyaan.destroyDirect');

    Route::get('/pertanyaan/multiple-answer', 'PertanyaanController@createMultiple')->name('pertanyaan.createMultiple');
    Route::get('/pertanyaan/edit-multiple/{id}','PertanyaanController@editMultiple')->name('pertanyaan.editMultiple');
    Route::post('/pertanyaan/store-multiple','PertanyaanController@storeMultiple')->name('pertanyaan.storeMultiple');
    Route::patch('/pertanyaan/update-multiple/{id}','PertanyaanController@updateMultiple')->name('pertanyaan.updateMultiple');
    Route::get('/pertanyaan/delete-multiple/{id}','PertanyaanController@destroyMultiple')->name('pertanyaan.destroyMultiple');

    Route::get('/laporan/jarak', 'LaporanJarakController@haversine')->name('jarak.haversine');
    Route::get('/laporan/jarak/detail/{id}', 'LaporanJarakController@showJarak')->name('laporan.showJarak');
    Route::get('/laporan/jarak/export','LaporanJarakController@export')->name('jarak.export');

    Route::get('/laporan/jabatan-perusahaan', 'LaporanJabatanController@jabatan')->name('laporan.jabatan');
    Route::get('/laporan/jabatan-perusahaan/export','LaporanJabatanController@export')->name('pekerjaan.export');
    Route::get('/chart/jabatan', 'LaporanJabatanController@indexChartJabatan')->name('laporan.indexChartJabatan');
    Route::get('/chart-jabatan', 'LaporanJabatanController@chartJabatan')->name('laporan.chartJabatan');
    Route::get('/chart/jabatan/detail/{id}', 'LaporanJabatanController@showJabatan')->name('laporan.showJabatan');

    Route::get('/chart/perusahaan', 'LaporanPerusahaanController@indexChartPerusahaan')->name('laporan.indexChartPerusahaan');
    Route::get('/chart-perusahaan', 'LaporanPerusahaanController@chartPerusahaan')->name('laporan.chartPerusahaan');
    Route::get('/chart/perusahaan/detail/{id}', 'LaporanPerusahaanController@showPerusahaan')->name('laporan.showPerusahaan');

    Route::get('/chart/bidang', 'LaporanController@indexChartBidang')->name('laporan.indexChartBidang');
    Route::get('/chart/bidang/detail/{id}', 'LaporanController@showBidang')->name('laporan.showBidang');
    Route::get('/chart-bidang', 'LaporanController@chartBidang')->name('laporan.chartBidang');

    Route::get('/chart/waktuPekerjaan', 'LaporanController@indexChartWaktuPekerjaan')->name('laporan.indexChartWaktuPekerjaan');
    Route::get('/chart/waktuPekerjaan/detail/{id}', 'LaporanController@showWaktuPekerjaan')->name('laporan.showWaktuPekerjaan');
    Route::get('/chart-waktuPekerjaan', 'LaporanController@chartWaktuPekerjaan')->name('laporan.chartWaktuPekerjaan');

    Route::get('/laporan/tahun-kelulusan', 'LaporanController@tahunKelulusan')->name('laporan.tahunKelulusan');
    Route::get('/chart-tahun-kelulusan', 'LaporanController@chartTahunKelulusan')->name('laporan.chartTahunKelulusan');
    Route::get('/laporan/tahun-kelulusan/detail/{lulusan}', 'LaporanController@detailKelulusan')->name('laporan.detailKelulusan');

    Route::get('/laporan/hasil-kuesioner', 'KuesionerController@hasil')->name('kuesioner.hasil');

    Route::get('/laporan/kepuasan-alumni', 'LaporanController@kepuasanAlumni')->name('laporan.kepuasanAlumni');

    Route::get('/laporan/index', 'LaporanController@index')->name('laporan.index');

});


Route::post('/jabatan/store/alumni','JabatanController@storealumni')->name('jabatan.storealumni');

Route::get('/tracer-study/alumni', 'AlumniController@create')->name('alumni.create');
Route::post('/tracer-study/alumni/store/{id}','AlumniController@store')->name('alumni.store');
Route::post('/mahasiswa/store/alumni','MahasiswaController@storealumni')->name('mahasiswa.storealumni');

Route::get('/tracer-study/pekerjaan/{id}','HistoryPekerjaanController@index')->name('historypekerjaan.index');
Route::post('/tracer-study/pekerjaan/store/{id}','HistoryPekerjaanController@store')->name('historypekerjaan.store');

Route::post('/perusahaan/store/alumni','PerusahaanController@storealumni')->name('perusahaan.storealumni');
Route::get('/tracer-study/perusahaan/create', 'PerusahaanController@createAlumni')->name('perusahaan.createAlumni');

Route::get('/kuesioner','KuesionerController@index')->name('kuesioner.index');
Route::get('/kuesioner/{id}','KuesionerController@show')->name('kuesioner.show');
Route::get('/kuesioner/direct-answer/{id}','KuesionerController@createDirect')->name('kuesioner.createDirect');
Route::get('/kuesioner/multi-answer/{id}','KuesionerController@createMultiple')->name('kuesioner.createMultiple');
Route::post('/kuesioner','KuesionerController@store')->name('kuesioner.store');
Route::post('/kuesioner-direct','KuesionerController@storeDirect')->name('kuesioner.storeDirect');
Route::post('/kuesioner-multiple','KuesionerController@storeMultiple')->name('kuesioner.storeMultiple');

Route::get('/tracer-study/sektor/create', 'SektorController@createAlumni')->name('sektor.createAlumni');
Route::post('/tracer-study/sektor/store','SektorController@storeAlumni')->name('sektor.storeAlumni');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/roles','RoleController@index')->name('roles.index');

// Route::group(['middleware' => ['auth']], function() {

// });
