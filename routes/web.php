<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('/pengurus/login', 'Auth\LoginController@login')->name('pengurus.login.post');
Route::post('/pengurus/logout', 'Auth\LoginController@logout')->name('pengurus.logout');
Route::get('/dashboard', 'DashboardController@index');

//------------------------------------------------------KOTA----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/kota', 'KotaController@index');
Route::get('/kota/create', 'KotaController@create');
Route::post('/kota/store', 'KotaController@store');
Route::get('/kota/edit/{id_kota}', 'KotaController@edit');
Route::put('/kota/update/{id_kota}', 'KotaController@update');
Route::get('/kota/delete/{id_kota}', 'KotaController@delete');

//------------------------------------------------------SEAT----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/seat', 'SeatController@index');
Route::get('/seat/create', 'SeatController@create');
Route::post('/seat/store', 'SeatController@store');
Route::get('/seat/edit/{id_seat}', 'SeatController@edit');
Route::put('/seat/update/{id_seat}', 'SeatController@update');
Route::get('/seat/delete/{id_seat}', 'SeatController@delete');


//------------------------------------------------------RUTE----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/rute', 'RuteController@index');
Route::get('/rute/create', 'RuteController@create');
Route::post('/rute/store', 'RuteController@store');
Route::get('/rute/edit/{id_kota_asal}/{id_kota_tujuan}', 'RuteController@edit');
Route::put('/rute/update/{id_kota_asal}/{id_kota_tujuan}', 'RuteController@update');
Route::get('/rute/delete/{id_kota_asal}/{id_kota_tujuan}', 'RuteController@delete');
Route::get('/rute/export', 'RuteController@export');

//------------------------------------------------------USERS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/users', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::post('/users/store', 'UsersController@store');
Route::get('/users/edit/{id_users}', 'UsersController@edit');
Route::put('/users/update/{id_users}', 'UsersController@update');
Route::get('/users/delete/{id_users}', 'UsersController@delete');

//------------------------------------------------------SOPIR----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/sopir', 'SopirController@index');
Route::get('/sopir/create', 'SopirController@create');
Route::post('/sopir/store', 'SopirController@store');
Route::get('/sopir/edit/{id_sopir}', 'SopirController@edit');
// Route::get('/sopir/show/{id_sopir}', 'SopirController@show');
Route::put('/sopir/update/{id_sopir}', 'SopirController@update');
Route::get('/sopir/delete/{id_sopir}', 'SopirController@delete');

//------------------------------------------------------FEEDER----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/feeder', 'FeederController@index');
Route::get('/feeder/create', 'FeederController@create');
Route::post('/feeder/store', 'FeederController@store');
Route::get('/feeder/edit/{id_feeder}', 'FeederController@edit');
// Route::get('/feeder/show/{id_feeder}', 'FeederController@show');
Route::put('/feeder/update/{id_feeder}', 'FeederController@update');
Route::get('/feeder/delete/{id_feeder}', 'FeederController@delete');

//------------------------------------------------------MOBIL----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/mobil', 'MobilController@index');
Route::get('/mobil/create', 'MobilController@create');
Route::post('/mobil/store', 'MobilController@store');
Route::get('/mobil/edit/{plat_mobil}', 'MobilController@edit');
Route::get('/mobil/show/{plat_mobil}', 'MobilController@show');
Route::put('/mobil/update/{plat_mobil}', 'MobilController@update');
Route::get('/mobil/delete/{plat_mobil}', 'MobilController@delete');

//------------------------------------------------------PEMESAN----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/pemesan', 'PemesanController@index');
Route::get('/pemesan/create', 'PemesanController@create');
Route::post('/pemesan/store', 'PemesanController@store');
// Route::post('/pemesan/store1', 'PemesanController@store1');
Route::get('/pemesan/edit/{id_pemesan}', 'PemesanController@edit');
// Route::get('/pemesan/show/{id_pemesan}', 'PemesanController@show');
Route::put('/pemesan/update/{id_pemesan}', 'PemesanController@update');
Route::get('/pemesan/delete/{id_pemesan}', 'PemesanController@delete');

//------------------------------------------------------PENGURUS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/pengurus', 'PengurusController@index');
Route::get('/pengurus/create', 'PengurusController@create');
Route::get('/pengurus/register', 'PengurusController@register');
Route::post('/pengurus/store', 'PengurusController@store');
Route::get('/pengurus/edit/{id_pengurus}', 'PengurusController@edit');
Route::get('/pengurus/show/{id_pengurus}', 'PengurusController@show');
Route::put('/pengurus/update/{id_pengurus}', 'PengurusController@update');
Route::get('/pengurus/delete/{id_pengurus}', 'PengurusController@delete');

//------------------------------------------------------TRIP----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('trip', 'TripController@index');
Route::get('/trip/create', 'TripController@create');
Route::post('/trip/store', 'TripController@store');
Route::get('/trip/edit/{jadwal}/{plat_mobil}', 'TripController@edit');
Route::put('/trip/update/{jadwal}/{plat_mobil}', 'TripController@update');
Route::get('/trip/delete/{jadwal}/{plat_mobil}', 'TripController@delete');
Route::get('/trip/show/{jadwal}/{plat_mobil}', 'TripController@show');
Route::get('/trip/show/{jadwal}/{plat_mobil}/cancel', 'TripController@show_cancel');
Route::get('/trip_kota_tujuan', 'TripController@getKotaTujuan');

//------------------------------------------------------PESANAN----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('pesanan', 'PesananController@index');
Route::get('/pesanan/create', 'PesananController@create');
Route::post('/pesanan/create_search', 'PesananController@search');
Route::get('/pesanan/create_detail/{jumlah_penumpang}/{jadwal}/{plat_mobil}/{id_pemesan}', 'PesananController@detail');
Route::post('/pesanan/store/{jumlah_penumpang}/{jadwal}/{plat_mobil}/{id_pemesan}', 'PesananController@store');

Route::get('/pesanan/edit/{id_pemesan}/{jadwal}/{plat_mobil}', 'PesananController@edit');
Route::put('/pesanan/update/{id_pemesan}/{jadwal}/{plat_mobil}', 'PesananController@update');
Route::get('/pesanan/update_create/{id_pemesan}/{jadwal}/{plat_mobil}', 'PesananController@update_create');
Route::post('/pesanan/update_store/{jumlah_penumpang}/{id_pemesan}/{jadwal}/{plat_mobil}', 'PesananController@update_store');
Route::get('/pesanan/update_detail/{jadwal}/{plat_mobil}/{id_pemesan}', 'PesananController@update_detail');

Route::get('/pesanan/delete/{id_pemesan}/{jadwal}/{plat_mobil}', 'PesananController@delete');
Route::get('/pesanan/show/{id_pemesan}/{jadwal}/{plat_mobil}', 'PesananController@show');
Route::get('/pesanan/print/{id_pemesan}/{jadwal}/{plat_mobil}', 'PesananController@print');
Route::get('/pesanan_trip', 'PesananController@getTrip');

//----------------------------------------------------REPORT-------------------------------------------------
Route::get('report', 'ReportController@index');
Route::post('report/show', 'ReportController@show');

Route::get('/logout','\App\Http\Controllers\Auth\LoginController@logout');

//------------------------------------------------------ROLES----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('roles', 'RoleController@index');
Route::get('/roles/create', 'RoleController@create');
Route::post('/roles/store', 'RoleController@store');
Route::get('/roles/edit/{id}', 'RoleController@edit');
Route::put('/roles/update/{id}', 'RoleController@update')->name('roles.update');
Route::get('/roles/delete/{id}', 'RoleController@delete');
Route::get('/roles/show/{id}', 'RoleController@show');

//------------------------------------------------------PERMISSIONS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('permissions', 'PermissionController@index');
Route::get('/permissions/create', 'PermissionController@create');
Route::post('/permissions/store', 'PermissionController@store');
Route::get('/permissions/edit/{id}', 'PermissionController@edit');
Route::put('/permissions/update/{id}', 'PermissionController@update')->name('permissions.update');
Route::get('/permissions/delete/{id}', 'PermissionController@delete');
Route::get('/permissions/show/{id}', 'PermissionController@show');

