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
use DB;

class DashboardController extends Controller
{
    public function index(){
    	if (Auth::guard('pengurus')->user()->id_pengurus == 'admin') {
    		$kota = Auth::guard('pengurus')->user()->id_kota;
	    	$feeder = Feeder::all()->count();
	    	$pemesan = Pemesan::all()->count();
	    	$sopir = Sopir::all()->count();
	    	$pesanan = Pesanan::all()->count();
	    	$today = Carbon::now();
	    	$filter_today = '%'.date('Y-m-d', strtotime($today)).'%';
	    	$filter_jam = date('Y-m-d H:i:s', strtotime($today));
	    	$trip = Trip::where('jadwal', 'like', $filter_today)
	    						->where('jadwal', '>', $filter_jam)
	    						->orderBy('jadwal', 'asc')->paginate(10);

	        return view('dashboard', ['feeder' => $feeder, 'pemesan' => $pemesan, 'sopir' => $sopir, 'pesanan' => $pesanan, 'today' => $today, 'trip' => $trip]);              
        }else{
        	$kota = Auth::guard('pengurus')->user()->id_kota;
	    	$feeder = Feeder::where('id_kota', $kota)->count();
	    	$pemesan = Pemesan::all()->count();
	    	$sopir = Sopir::all()->count();
	
			$pesanan = DB::table('pesanan')
						->join('trip', function ($join) {
							$join->on('pesanan.jadwal', '=', 'trip.jadwal')->On('pesanan.plat_mobil', '=', 'trip.plat_mobil');
						})
						->where('trip.id_kota_asal', $kota)
						->count();
						
	        $today = Carbon::now();
	    	$filter_today = '%'.date('Y-m-d', strtotime($today)).'%';
	    	$filter_jam = date('Y-m-d H:i:s', strtotime($today));
	  
	    	$trip = Trip::where('id_kota_asal', '=', $kota)
	    				->where('jadwal', 'like', $filter_today)
	    				->where('jadwal', '>', $filter_jam)
	    				->orderBy('jadwal', 'asc')->paginate(10);

	        return view('dashboard', ['feeder' => $feeder, 'pemesan' => $pemesan, 'sopir' => $sopir, 'pesanan' => $pesanan, 'today' => $today, 'trip' => $trip]);
        }
    	
    }
}