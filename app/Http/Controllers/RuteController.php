<?php

namespace App\Http\Controllers;

use App\Exports\RuteExport;
use App\Kota;
use App\Rute;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RuteController extends Controller
{
    public function index(){
    	$rute = Rute::all();
    	return view('erte.rute.index', ['rute' => $rute]);
    }

    public function create(){
        $rute = Rute::all();
        $kota_asal = Kota::all();
        $kota_tujuan = Kota::all();

        return view('erte.rute.create', ['rute' => $rute, 'kota_asal' => $kota_asal, 'kota_tujuan' => $kota_tujuan]);
    }
    
    public function store(Request $request){
    	$this->validate($request, [
    		'id_kota_asal' => 'required',
    		'id_kota_tujuan' => 'required',
    		'tarif' => 'required']);

        $rute = Rute::create([
            'id_kota_asal' => $request->id_kota_asal,
            'id_kota_tujuan' => $request->id_kota_tujuan,
            'tarif' => $request->tarif
        ]);

        session()->flash('flash_success', 'Berhasil menambahkan data rute '.$rute->id_kota_asal .' - '.$rute->id_kota_tujuan);
    	return redirect('/rute');
    }

    public function edit($id_kota_asal, $id_kota_tujuan){
        $rute = Rute::where(['id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan])->first();
		$kota_asal = Kota::all();
        $kota_tujuan = Kota::all();    	
    	
    	return view('erte.rute.edit', ['rute' => $rute, 'kota_asal' => $kota_asal, 'kota_tujuan' => $kota_tujuan]);
    }

    public function update($id_kota_asal, $id_kota_tujuan, Request $request){
    	$this->validate($request, [
    		'id_kota_asal' => 'required',
    		'id_kota_tujuan' => 'required',
    		'tarif' => 'required']);

    	$rute = Rute::where(['id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan])->first();
    	$rute->id_kota_asal = $request->id_kota_asal;
    	$rute->id_kota_tujuan = $request->id_kota_tujuan;
        $rute->tarif = $request->tarif;
    	$rute->save();

        session()->flash('flash_success', 'Berhasil mengupdate data');
        return redirect('/rute');
    }

    public function delete($id_kota_asal, $id_kota_tujuan){
    	$rute = Rute::where(['id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan])->first();
    	$rute->delete();

        session()->flash('flash_success', "Berhasil menghapus rute ".$rute->id_kota_asal .' - '.$rute->id_kota_tujuan);
        return redirect('/rute');
    }
}
