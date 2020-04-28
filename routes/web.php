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

// Route::get('/operator/login', 'Auth\LoginController@showLoginForm')->name('operator.login');
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('/operator/login', 'Auth\LoginController@login')->name('operator.login.post');
Route::post('/operator/logout', 'Auth\LoginController@logout')->name('operator.logout');

/*
 _  teacher profile routes
 */
// Route::group(['middleware'=>'operator'], function() {
//     return view('dashboard');
// });

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware('auth');

// Route::get('/home',function(){
// 	return view('dashboard');
// })->name('home');

// Route::get('/home',function(){
// 	return view('home');

Route::get('/dashboard', function(){
	return view('dashboard');
});

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
Route::get('/sopir/edit/{id_users}', 'SopirController@edit');
Route::get('/sopir/show/{id_users}', 'SopirController@show');
Route::put('/sopir/update/{id_users}', 'SopirController@update');
Route::get('/sopir/delete/{id_users}', 'SopirController@delete');

//------------------------------------------------------FEEDER----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/feeder', 'FeederController@index');
Route::get('/feeder/create', 'FeederController@create');
Route::post('/feeder/store', 'FeederController@store');
Route::get('/feeder/edit/{id_users}', 'FeederController@edit');
Route::get('/feeder/show/{id_users}', 'FeederController@show');
Route::put('/feeder/update/{id_users}', 'FeederController@update');
Route::get('/feeder/delete/{id_users}', 'FeederController@delete');

//------------------------------------------------------PEMESAN----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/pemesan', 'PemesanController@index');
Route::get('/pemesan/create', 'PemesanController@create');
Route::post('/pemesan/store', 'PemesanController@store');
Route::get('/pemesan/edit/{id_users}', 'PemesanController@edit');
Route::get('/pemesan/show/{id_users}', 'PemesanController@show');
Route::put('/pemesan/update/{id_users}', 'PemesanController@update');
Route::get('/pemesan/delete/{id_users}', 'PemesanController@delete');

//------------------------------------------------------OPERATOR----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/operator', 'OperatorController@index');
Route::get('/operator/create', 'OperatorController@create');
Route::get('/operator/register', 'OperatorController@register');
Route::post('/operator/store', 'OperatorController@store');
Route::get('/operator/edit/{id_users}', 'OperatorController@edit');
Route::get('/operator/show/{id_users}', 'OperatorController@show');
Route::put('/operator/update/{id_users}', 'OperatorController@update');
Route::get('/operator/delete/{id_users}', 'OperatorController@delete');

//------------------------------------------------------TRIP----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('trip', 'TripController@index');
Route::get('/trip/create', 'TripController@create');
Route::post('/trip/store', 'TripController@store');
Route::get('/trip/edit/{id_trip}', 'TripController@edit');
Route::put('/trip/update/{id_trip}', 'TripController@update');
Route::get('/trip/delete/{id_trip}', 'TripController@delete');
Route::get('/trip/show/{id_trip}', 'TripController@show');
Route::get('/trip_kota_tujuan', 'TripController@getKotaTujuan');

//------------------------------------------------------PESANAN----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('pesanan', 'PesananController@index');
Route::get('/pesanan/create', 'PesananController@create');
Route::post('/pesanan/store', 'PesananController@store');
Route::get('/pesanan/edit/{id_pesanan}/{id_trip}', 'PesananController@edit');
Route::put('/pesanan/update/{id_pesanan}/{id_trip}', 'PesananController@update');
Route::get('/pesanan/delete/{id_pesanan}/{id_trip}', 'PesananController@delete');
Route::get('/pesanan/show/{id_pesanan}/{id_trip}', 'PesananController@show');
Route::get('/pesanan_trip', 'PesananController@getTrip');

//------------------------------------------------------DETAIL PESANAN----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('detail_pesanan', 'DetailPesananController@index');
Route::get('/detail_pesanan/create', 'DetailPesananController@create');
Route::post('/detail_pesanan/store', 'DetailPesananController@store');
Route::get('/detail_pesanan/edit/{id_trip}/{id_seat}}', 'DetailPesananController@edit');
Route::put('/detail_pesanan/update/{id_trip}/{id_seat}', 'DetailPesananController@update');
Route::get('/detail_pesanan/delete/{id_trip}/{id_seat}', 'DetailPesananController@delete');
Route::get('/detail_pesanan/show/{id_trip}/{id_seat}', 'DetailPesananController@show');


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

// -----------Spatie---------------

// Route::get('/roles', function(){
// 	$role = Role::create(['name' => 'operator']);
// 	$permission =  Permission::create(['name' => 'manage_users']);
// 	Auth()->user()->assignRole('operator');
// 	Auth()->user()->givePermissionTo('manage_users');


// });


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
