<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\Trip;
use App\Pemesan;
use App\Users;

class PesananController extends Controller
{
    public function index(){
    	$pesanan = Pesanan::all();
    	$trip = Trip::all();
    	// $pemesan = Pemesan::all();
    	$users = Users::all();
        return view('erte.pesanan.index', ['pesanan' => $pesanan, 'trip' => $trip,  'users' => $users]);
    }

    public function create(){
    	$pesanan = Pesanan::all();
    	$trip = Trip::all();
    	$users = Users::all();
    	// $pemesan = Pemesan::all();
    	
     	return view('erte.pesanan.create', ['pesanan' => $pesanan, 'trip' => $trip, 'users' => $users]);
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
    		'id_trip' => 'required',
    		'id_users_pemesan' => 'required',
    		'tanggal_pesan' => 'required'
        ]);

    	Pesanan::create([
    		'id_trip' => $request->id_trip,
            'id_users_pemesan' => $request->id_users_pemesan,
            'tanggal_pesan' => $request->tanggal_pesan
    	]);

    	

        session()->flash('flash_success', 'Berhasil menambahkan data pesanan ');

    	return redirect('/pesanan');
    }

    public function edit($id_trip, $id_users_pemesan){
    	$pesanan = Pesanan::find($id_trip, $id_users_pemesan);
    	$trip = Trip::all();
    	$pemesan = Pemesan::all();
        
        return view('erte.pesanan.edit', ['pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan]);
    }

    public function update($id_trip, $id_users_pemesan, Request $request){
    	 $this->validate($request, [
            'id_trip' => 'required',
            'id_users_pemesan' => 'required',
            'tanggal_pesan' => 'required']);

            $pesanan = Pesanan::find($id_trip, $id_users_pemesan);
            $pesanan->id_trip = $request->id_trip;
            $pesanan->id_users_pemesan = $request->id_users_pemesan;
            $pesanan->tanggal_pesan = $request->tanggal_pesan;
            $pesanan->save();

            session()->flash('flash_success', 'Berhasil mengupdate data pesanan');

        

         return redirect('/pesanan');
    }

 	public function delete($id_trip, $id_users_pemesan){
        $pesanan = Pesanan::find($id_trip, $id_users_pemesan);
        $pesanan->delete();

        session()->flash('flash_success', "Berhasil menghapus pesanan");
        return redirect('/pesanan');
    	
    }




}
