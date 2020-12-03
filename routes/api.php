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

	Route::get('/search/{id_kota_asal}/{id_kota_tujuan}/{tanggal}/{jumlah_penumpang}', 'ApiController@pesananSearch');
	Route::get('/check/{jumlah_penumpang}/{id_trip}/{id_users_pemesan}', 'ApiController@check');
	Route::post('/create_detail', 'ApiController@createDetail');
	
	Route::get('/history/{id_users_pemesan}', 'ApiController@riwayatTripPemesan');
	Route::get('/detail/{id_pesanan}', 'ApiController@detailRiwayatTripPemesan');
	Route::get('/trip/', 'ApiController@lihatTrip');
	Route::post('/create_pesanan/', 'ApiController@create_pesanan');
	Route::get('/seat/{id_trip}', 'ApiController@seat');


});


