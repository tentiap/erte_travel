<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Rute;
use App\Sopir;
use App\Operator;


class TripController extends Controller
{
    public function index(){
    	$trip = Trip::all();
        // $operator = Operator::all();
        // $sopir = Sopir::all();

    	return view('erte.trip.index', ['trip' => $trip]);

    }

    public function create(){
        $trip = Trip::all();
        $operator = Operator::all();
        $sopir = Sopir::all();
        $rute = Rute::all();
        
        return view('erte.trip.create', ['trip' => $trip, 'operator' => $operator, 'sopir' => $sopir, 'rute' => $rute]);
    	
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_trip' => 'required',
            'id_users_operator' => 'required',
            // 'id_users_sopir' => 'required',
            'id_kota_asal' => 'required',
            'id_kota_tujuan' => 'required',
            'jadwal' => 'required'
            
        ]);

         Trip::create([
            'id_trip' => $request->id_trip,
            'id_users_operator' => $request->id_users_operator,
            'id_users_sopir' => $request->id_users_sopir,
            'id_kota_asal' => $request->id_kota_asal,
            'id_kota_tujuan' => $request->id_kota_tujuan,
            'jadwal' => $request->jadwal
        ]);

                session()->flash('flash_success', 'Berhasil menambahkan data trip dengan ID '. $request->input('id_trip')); 

         return redirect('/trip');
    }

    public function edit($id_trip){
    	$trip = Trip::find($id_trip);
        $operator = Operator::all();
        $sopir = Sopir::all();
        $rute = Rute::all();
        return view('erte.trip.edit', ['trip' => $trip, 'operator' => $operator, 'sopir' => $sopir, 'rute' => $rute]);
    }

     public function show($id_trip){

        // $operator = Operator::
        $trip = Trip::find($id_trip);
        // $kota = Kota::find($id_trip);
        
        return view('erte.trip.show', ['trip' => $trip]);

    }

    public function update($id_trip, Request $request){
    	 $this->validate($request, [
            'id_trip' => 'required',
            'id_users_operator' => 'required',
            // 'id_users_sopir' => 'required',
            'id_kota_asal' => 'required',
            'id_kota_tujuan' => 'required',
            'jadwal' => 'required']);

            $trip = Trip::find($id_trip);
            $trip->id_trip = $request->id_trip;
            $trip->id_users_operator = $request->id_users_operator;
            $trip->id_users_sopir = $request->id_users_sopir;
            $trip->id_kota_asal = $request->id_kota_asal;
            $trip->id_kota_tujuan = $request->id_kota_tujuan;
            $trip->jadwal = $request->jadwal;
            
            $trip->save();

            session()->flash('flash_success', 'Berhasil mengupdate data trip '.$trip->id_trip);

         return redirect('/trip');
    }

 	public function delete($id_trip){
        $trip = Trip::find($id_trip);
        $trip->delete();

        session()->flash('flash_success', "Berhasil menghapus trip ".$trip->id_trip);
        return redirect('/trip');
    	
    }
}
