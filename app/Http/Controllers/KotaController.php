<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kota;

class KotaController extends Controller
{
    public function index(){
    	$kota = Kota::all();
    	return view('erte.kota.index', ['kota' => $kota]);
    }

    public function create(){
    	return view('erte.kota.create');
    }
    
    public function store(Request $request){
    	$this->validate($request, [
    		'id_kota' => 'required',
    		'nama_kota' => 'required']);

    	Kota::create([
    		'id_kota' => $request->id_kota,
    		'nama_kota' => $request->nama_kota
    	]);

        session()->flash('flash_success', 'Berhasil menambahkan data kota dengan nama '. $request->input('nama_kota'));

    	return redirect('/kota');

    }

    public function edit($id_kota){
    	$kota = Kota::find($id_kota);
    	return view('erte.kota.edit', ['kota' => $kota]);
    }

    public function update($id_kota, Request $request){
    	$this->validate($request, [
    		'id_kota' => 'required',
    		'nama_kota' => 'required']);

    	$kota = Kota::find($id_kota);
    	$kota->id_kota = $request->id_kota;
    	$kota->nama_kota = $request->nama_kota;
    	$kota->save();

        session()->flash('flash_success', 'Berhasil mengupdate data kota '.$kota->nama_kota);
        return redirect('/kota');
    }

    public function delete($id_kota){
    	$kota = Kota::find($id_kota);
    	$kota->delete();
        session()->flash('flash_success', "Berhasil menghapus kota ".$kota->nama_kota);
        return redirect('/kota');
    }

}
