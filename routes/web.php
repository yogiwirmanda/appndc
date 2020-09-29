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


Route::get('/', 'PasienFrontController@index')->name('home');
Route::get('/fpasiens/login','PasienFrontController@login');
Route::get('/fpasiens/loginPasien/{param1}/{param2}','PasienFrontController@loginPasien');
Route::get('/fpasiens/loadJadwal/','PasienFrontController@loadJadwal');
Route::get('/fpasiens/loadJadwalDokter/','PasienFrontController@loadJadwalDokter');
Route::get('/fpasiens/logout/','PasienFrontController@logout');
Route::get('/fantrians/confirm/{param}/{param1}','AntrianController@Confirm');
Route::get('/fdashboard','PasienFrontController@dashboard');
Route::get('/fantrians/pdf/{param1}/{param2}/{param3}/{param4}/{param5}/{param6}/{param7}','AntrianController@pdf');
Route::resource('fpasiens','PasienFrontController');
Route::resource('fantrians','AntrianController');

Auth::routes();
Route::middleware('auth')->group(function(){
  Route::get('/admin', 'HomeController@index')->name('home');
  Route::get('/dashboard', 'HomeController@index')->name('home');
  Route::get('pemeriksaans/{param}','PemeriksaanController@index');
  Route::get('/pasiens/detailPasien/{param}','PasienController@detailPasien');
  Route::get('/pemeriksaans/inputTabel/{param}/{param2}/{param3}','PemeriksaanController@inputTabel');
  Route::get('/pemeriksaans/loadTabelDiagnosa/{param1}','PemeriksaanController@loadTabelDiagnosa');
  Route::get('/pemeriksaans/loadTabelTindakan/{param1}','PemeriksaanController@loadTabelTindakan');
  Route::get('/pemeriksaans/loadTabelObat/{param1}','PemeriksaanController@loadTabelObat');
  Route::get('/pemeriksaans/delRowDiagnosa/{param1}/{param2}','PemeriksaanController@delRowDiagnosa');
  Route::get('/pemeriksaans/delRowTindakan/{param1}','PemeriksaanController@delRowTindakan');
  Route::get('/pemeriksaans/delRowObat/{param1}/{param2}','PemeriksaanController@delRowObat');
  Route::get('/kehadirans/{param1}','KehadiranController@index');
  Route::get('autocompleteDiagnosa','PemeriksaanController@autocompleteDiagnosa')->name('autocompleteDiagnosa');
  Route::get('pasiens/kunjunganPasien/{param}','PasienController@kunjunganPasien');
  Route::get('lpendaftarans/laporanHarian/{param}','LaporanPendaftaranController@laporanHarian');
  Route::resource('pasiens','PasienController');
  Route::resource('tempats','TempatController');
  Route::resource('dokters','DokterController');
  Route::resource('jadwals','JadwalController');
  Route::resource('kehadirans','KehadiranController');
  Route::resource('icds','IcdController');
  Route::resource('obats','ObatController');
  Route::resource('tindakans','TindakanController');
  Route::resource('pemeriksaans','PemeriksaanController');
  Route::resource('lpendaftarans','LaporanPendaftaranController');
});
