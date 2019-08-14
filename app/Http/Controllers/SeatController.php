<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Seat;

class SeatController extends Controller
{
    public function index(){
    	$seat = Seat::all();
    	return view('erte.seat.index', ['seat' => $seat]);
    }

    public function create(){
    	return view('erte.seat.create');
    }
    
    public function store(Request $request){
    	$this->validate($request, [
    		'id_seat' => 'required',
    		'posisi' => 'required']);

    	Seat::create([
    		'id_seat' => $request->id_seat,
    		'posisi' => $request->posisi
    	]);

        // Flash::success('Mahasiswa saved successfully.');


        // session()->flash('flash_success', 'Berhasil menambahkan data kota dengan nama '. $request->input('nama_kota'));

    	return redirect('/seat');
        // return redirect()->route('kota.index', [$kota->id_kota]);
    }

    public function edit($id_seat){
    	$seat = Seat::find($id_seat);
    	return view('erte.seat.edit', ['seat' => $seat]);
    }

    public function update($id_seat, Request $request){
    	$this->validate($request, [
    		'id_seat' => 'required',
    		'posisi' => 'required']);

    	$seat = Seat::find($id_seat);
    	$seat->id_seat = $request->id_seat;
    	$seat->posisi = $request->posisi;
    	$seat->save();

        // Flash::success('Kota berhasil ditambahkan');
        // session()->flash('flash_success', 'Berhasil mengupdate data kota '.$kota->nama_kota);
    	// return redirect()->route('kota.index', [$kota->id_kota] );
        return redirect('/seat');
    }

    public function delete($id_seat){
    	$seat = Seat::find($id_seat);
    	$seat->delete();
        // session()->flash('flash_success', "Berhasil menghapus kota ".$kota->nama_kota);
    	// return redirect()->route('kota.index');
        return redirect('/seat');
    }

}
