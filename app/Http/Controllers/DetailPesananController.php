<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\Detail_Pesanan;
use App\Trip;
use App\Pemesan;
use App\Seat;
use App\Feeder;

class DetailPesananController extends Controller
{
    public function index(){
    	$detail_pesanan = Detail_Pesanan::all();
    	$pesanan = Pesanan::all();
       	$pemesan = Pemesan::all();
        $feeder = Feeder::all();
        $trip = Trip::all();

        return view('erte.detail_pesanan.index', ['detail_pesanan' => $detail_pesanan,'pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan, 'feeder' => $feeder]);
    }

    public function create(){
    	$detail_pesanan = Detail_Pesanan::all();
    	$pesanan = Pesanan::all();
    	$trip = Trip::all();
    	$pemesan = Pemesan::all();
        $feeder = Feeder::all();
    	$seat = Seat::all();
    	    	
     	return view('erte.detail_pesanan.create', ['detail_pesanan' => $detail_pesanan,'pesanan' => $pesanan, 'trip' => $trip, 'seat' => $seat, 'pemesan' => $pemesan, 'feeder' => $feeder]);
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
    		'id_trip' => 'required',
            'id_seat' => 'required',
            // 'id_users_feeder' => 'required',
    		'nama_penumpang' => 'required',
    		'jenis_kelamin' => 'required',
    		'detail_asal' => 'required',
    		'detail_tujan' => 'required',
            'no_hp' => 'required',
            'status' => 'required',
            // 'biaya_tambahan' => 'required',
            'id_pesanan' => 'required'
        ]);

    	Detail_Pesanan::create([
    		'id_trip' => $request->id_trip,
            'id_seat' => $request->id_seat,
            'id_users_feeder' => $request->id_users_feeder,
            'nama_penumpang' => $request->nama_penumpang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'detail_asal' => $request->detail_asal,
            'detail_tujuan' => $request->detail_tujuan,
            'no_hp' => $request->no_hp,
            'biaya_tambahan' => $request->biaya_tambahan,
            'status' => $request->status,
            'id_pesanan' => $request->id_pesanan
    	]);

        session()->flash('flash_success', 'Berhasil menambahkan detail pesanan ');

    	return redirect('/detail_pesanan');
    }

    public function edit($id_trip, $id_seat){
    	$detail_pesanan = Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $id_seat])->first();
    	$pesanan = Pesanan::all();
    	$trip = Trip::all();
    	$pemesan = Pemesan::all();
        $feeder = Feeder::all();
        
        return view('erte.pesanan.edit', ['detail_pesanan' => $detail_pesanan,'pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan, 'feeder' => $feeder]);
    }

    public function update($id_trip, $id_seat, Request $request){
    	 $this->validate($request, [
            'id_trip' => 'required',
            'id_seat' => 'required',
            'nama_penumpang' => 'required',
            'jenis_kelamin' => 'required',
            'detail_asal' => 'required',
            'detail_tujuan' => 'required',
            'status' => 'required',
            'id_pesanan' => 'required'         
        ]);

            $detail_pesanan = Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $id_seat])->first();
            $detail_pesanan->id_trip = $request->id_trip;
            $detail_pesanan->id_seat = $request->id_seat;
            $detail_pesanan->id_users_feeder = $request->id_users_feeder;
            $detail_pesanan->nama_penumpang = $request->nama_penumpang;
            $detail_pesanan->jenis_kelamin = $request->jenis_kelamin;
            $detail_pesanan->detail_asal = $request->detail_asal;
            $detail_pesanan->detail_tujuan = $request->detail_tujuan;
            $detail_pesanan->biaya_tambahan = $request->biaya_tambahan;
            $detail_pesanan->no_hp = $request->no_hp;
            $detail_pesanan->status = $request->status;
            $detail_pesanan->id_pesanan = $request->id_pesanan;

            $detail_pesanan->save();

            session()->flash('flash_success', 'Berhasil mengupdate detail pesanan');

         return redirect('/detail_pesanan');
    }

 	public function delete($id_trip, $id_seat){
        $detail_pesanan = Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $id_seat])->first();
        $detail_pesanan->delete();

        session()->flash('flash_success', "Berhasil menghapus detail pesanan");
        return redirect('/detail_pesanan');
    	
    }
}
