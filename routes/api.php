<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('api')->group(function () {
	Route::post('/register', 'ApiController@register');
	Route::post('/loginPemesan', 'ApiController@loginPemesan');
	Route::post('/loginSopir', 'ApiController@loginSopir');
	Route::post('/loginFeeder', 'ApiController@loginFeeder');

	Route::post('/createPesanan', 'ApiController@create_pesanan');
	Route::post('/createDetailPesanan', 'ApiController@create_detail_pesanan');



	Route::get('/search/{id_kota_asal}/{id_kota_tujuan}/{tanggal}/{jumlah_penumpang}', 'ApiController@pesananSearch');
	Route::get('/check/{jumlah_penumpang}/{id_trip}/{id_users_pemesan}', 'ApiController@check');
	Route::post('/create_detail/{jumlah_penumpang}/{id_trip}/{id_users_pemesan}', 'ApiController@createDetail');
	Route::get('/checkUpdate/{tambah}/{id_trip}/{id_users_pemesan}', 'ApiController@check_update');

	

	Route::get('/tripSopir/{id_users}', 'ApiController@tripSopir');
	Route::get('/historySopir/{id_users}', 'ApiController@riwayatTripSopir');
	Route::get('/detailTripSopir/{id_trip}', 'ApiController@detailTripSopir');

	Route::get('/getBookedSeat/{id_trip}', 'ApiController@getBookedSeat');
	Route::get('/getIdPesanan/{id_trip}/{id_users_pemesan}', 'ApiController@getIdPesanan');
	Route::get('/getDetailPesanan/{id_pesanan}/{id_trip}', 'ApiController@getDetailPesanan');
	Route::get('/checkAvailableSeat/{id_trip}', 'ApiController@checkAvailableSeat');


	Route::get('/tripFeeder/{id_users_feeder}', 'ApiController@Feeder');
	Route::post('/changeStatus/', 'ApiController@changeStatus');
	Route::post('/updateDataPemesan/', 'ApiController@updateDataPemesan');
	Route::post('/updateDetailPesanan/', 'ApiController@updateDetailPesanan');

	
	Route::get('/history/{id_users_pemesan}', 'ApiController@riwayatTripPemesan');
	Route::get('/detail/{id_pesanan}', 'ApiController@detailRiwayatTripPemesan');
	Route::get('/trip/', 'ApiController@lihatTrip');
	Route::post('/create_pesanan/', 'ApiController@create_pesanan');
	Route::get('/seat/{id_trip}', 'ApiController@seat');


});


