<?php

use Illuminate\Http\Request;
use App\Trip;

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

Route::get('/pesanan/date-time/{id_rute}', function($id){
	return response()->json(Trip::where('id_rute',$id)->get());
});
