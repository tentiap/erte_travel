<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rute;
use App\Kota;

class RuteController extends Controller
{
    public function index(){
    	$rute = Rute::all();
    	return view('erte.rute.index', ['rute' => $rute]);
    	// return view('erte.rute.index', compact('rute'));

    }

    public function create(){
    	$kota = Rute::with('kota')->get();
    	return view('erte.rute.create', ['rute' => $kota]);
    }
    
    public function store(Request $request){
    	$this->validate($request, [
    		'id_rute' => 'required',
    		'id_kota_asal' => 'required',
    		'id_kota_tujuan' => 'required',
    		'harga' => 'required']);

    	Rute::create([
    		'id_rute' => $request->id_rute,
    		'id_kota_asal' => $request->id_kota_asal,
    		'id_kota_tujuan' => $request->id_kota_tujuan,
    		'harga' => $request->harga
    	]);

        // Flash::success('Mahasiswa saved successfully.');


        // session()->flash('flash_success', 'Berhasil menambahkan data kota dengan nama '. $request->input('nama_kota'));

    	return redirect('/rute');
        // return redirect()->route('kota.index', [$kota->id_kota]);
    }

    public function edit($id_rute){
    	$kota_asal = Kota::all()->pluck('nama_kota');
    	$kota_tujuan = Kota::all()->pluck('nama_kota');
		    	
    	$rute = Rute::find($id_rute);
    	return view('erte.rute.edit', ['rute' => $rute]);
    }

    public function update($id_rute, Request $request){
    	$this->validate($request, [
    		'id_rute' => 'required',
    		'id_kota_asal' => 'required',
    		'id_kota_tujuan' => 'required',
    		'harga' => 'required']);

    	$rute = Rute::find($id_rute);
    	$rute->id_rute = $request->id_rute;
    	$rute->id_kota_asal = $request->id_kota_asal;
    	$rute->id_kota_tujuan = $request->id_kota_tujuan;
    	$rute->save();

        // Flash::success('Kota berhasil ditambahkan');
        // session()->flash('flash_success', 'Berhasil mengupdate data kota '.$kota->nama_kota);
    	// return redirect()->route('kota.index', [$kota->id_kota] );
        return redirect('/rute');
    }

    public function delete($id_rute){
    	$rute = Rute::find($id_rute);
    	$rute->delete();
        // session()->flash('flash_success', "Berhasil menghapus kota ".$kota->nama_kota);
    	// return redirect()->route('kota.index');
        return redirect('/rute');
    }
}
