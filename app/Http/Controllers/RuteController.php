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
    	// $kota = Rute::with('kota')->get();
        // $kota = Kota::all();
        $rute = Rute::all();
        $kota_asal = Kota::all();
        $kota_tujuan = Kota::all();

    	// return view('erte.rute.create', ['rute' => $kota]);
        return view('erte.rute.create', ['rute' => $rute, 'kota_asal' => $kota_asal, 'kota_tujuan' => $kota_tujuan]);

        // return view('erte.rute.create', compact('rute'), compact('kota_asal'), compact('kota_tujuan');
    }
    
    public function store(Request $request){
    	$this->validate($request, [
    		'id_rute' => 'required',
    		'id_kota_asal' => 'required',
    		'id_kota_tujuan' => 'required',
    		'harga' => 'required']);

        
    	// Rute::create([
    	// 	'id_rute' => $request->id_rute,
    	// 	'id_kota_asal' => $request->id_kota_asal,
    	// 	'id_kota_tujuan' => $request->id_kota_tujuan,
    	// 	'harga' => $request->harga
    	// ]);

        $rute = Rute::create([
            'id_rute' => $request->id_rute,
            'id_kota_asal' => $request->id_kota_asal,
            'id_kota_tujuan' => $request->id_kota_tujuan,
            'harga' => $request->harga
        ]);

        // $rute->kota_asal()->create($request->only('id_kota_asal'));

        // $rute->kota_tujuan()->create($request->only('id_kota_tujuan'));



        // $rute = new Rute();
        // $rute->id_rute = $request->id_rute;
        // $rute->id_kota_asal = $request->id_kota_asal;
        // $rute->id_kota_tujuan = $request->id_kota_tujuan;
        // $rute->harga = $request->harga;
        // $rute->save();

        

        // Flash::success('Mahasiswa saved successfully.');


        session()->flash('flash_success', 'Berhasil menambahkan data rute dengan ID '. $request->input('id_rute'));

    	return redirect('/rute');
        // return redirect()->route('kota.index', [$kota->id_kota]);
    }

    public function edit($id_rute){

        $rute = Rute::find($id_rute);
    	// $kota_asal = Kota::all()->pluck('nama_kota');
    	// $kota_tujuan = Kota::all()->pluck('nama_kota');

        // $kota_asal = Kota::find($id_kota);
        // $kota_tujuan = Kota::find($id_kota);

		$kota_asal = Kota::all();
        $kota_tujuan = Kota::all();    	
    	
    	return view('erte.rute.edit', ['rute' => $rute, 'kota_asal' => $kota_asal, 'kota_tujuan' => $kota_tujuan]);

                // return view('erte.rute.edit', ['rute' => $rute]);
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
        $rute->harga = $request->harga;
    	$rute->save();

        // Flash::success('Kota berhasil ditambahkan');
        session()->flash('flash_success', 'Berhasil mengupdate data rute '.$rute->id_rute);
    	// return redirect()->route('kota.index', [$kota->id_kota] );
        return redirect('/rute');
    }

    public function delete($id_rute){
    	$rute = Rute::find($id_rute);
    	$rute->delete();
        session()->flash('flash_success', "Berhasil menghapus rute ".$rute->id_rute);
    	// return redirect()->route('kota.index');
        return redirect('/rute');
    }
}
