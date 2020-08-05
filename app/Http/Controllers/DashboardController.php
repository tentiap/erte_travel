<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pemesan;
use App\Feeder;
use App\Sopir;
use App\Pesanan;
use App\Trip;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
    	if (Auth::guard('operator')->user()->id_users == 'admin') {
    		$kota = Auth::guard('operator')->user()->id_kota;
	    	$feeder = Feeder::all()->count();
	    	$pemesan = Pemesan::all()->count();
	    	$sopir = Sopir::all()->count();
	    	$pesanan = Pesanan::all()->count();
	    	$today = Carbon::now();
	    	$filter = '%'.date('Y-m-d', strtotime($today)).'%';
	    	$trip = Trip::where('jadwal', 'like', $filter)->get();
	    	
	        return view('dashboard', ['feeder' => $feeder, 'pemesan' => $pemesan, 'sopir' => $sopir, 'pesanan' => $pesanan, 'today' => $today, 'trip' => $trip]);              
        }else{
        	$kota = Auth::guard('operator')->user()->id_kota;
	    	$feeder = Feeder::where('id_kota', $kota)->count();
	    	$pemesan = Pemesan::all()->count();
	    	$sopir = Sopir::all()->count();
	    	$pesanan = Pesanan::join('trip', 'pesanan.id_trip', '=', 'trip.id_trip')
	                    ->where('trip.id_kota_asal',  $kota)
	                    ->count();
	        $today = Carbon::now();
	    	$filter = '%'.date('Y-m-d', strtotime($today)).'%';
	    	$trip = Trip::where('id_kota_asal', $kota)
	    				->where('jadwal', 'like', $filter)
	    				->get();
	                    
	        return view('dashboard', ['feeder' => $feeder, 'pemesan' => $pemesan, 'sopir' => $sopir, 'pesanan' => $pesanan, 'today' => $today, 'trip' => $trip]);
        }
    	
    }
}