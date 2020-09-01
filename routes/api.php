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
	Route::post('/loginPemesan', 'ApiController@loginPemesan');
	Route::get('/history/{id_users_pemesan}', 'ApiController@riwayatTrip');
	Route::get('/trip', 'ApiController@lihatTrip');
	Route::post('/create_pesanan/', 'ApiController@create_pesanan');


});


