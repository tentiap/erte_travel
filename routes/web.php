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

Route::get('/', function () {
    return view('laravel');
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
Route::get('/rute/edit/{id_rute}', 'RuteController@edit');
Route::put('/rute/update/{id_rute}', 'RuteController@update');
Route::get('/rute/delete/{id_rute}', 'RuteController@delete');

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



Route::get('/dashboard', function(){
	return view('dashboard');
});