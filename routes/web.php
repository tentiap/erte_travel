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
// Route::get('/rute/create', 'RuteController@create')->name('rute.create');
Route::post('/rute/store', 'RuteController@store');
Route::get('/rute/edit/{id_rute}', 'RuteController@edit');
Route::put('/rute/update/{id_rute}', 'RuteController@update');
Route::get('/rute/delete/{id_rute}', 'RuteController@delete');

Route::get('/dashboard', function(){
	return view('dashboard');
});