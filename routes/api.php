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

	Route::post('/search', 'ApiController@pesananSearch');
	Route::post('/create_detail', 'ApiController@createDetail');
	
	Route::post('/history', 'ApiController@riwayatTripPemesan');
	Route::get('/trip', 'ApiController@lihatTrip');
	Route::post('/create_pesanan/', 'ApiController@create_pesanan');


});


