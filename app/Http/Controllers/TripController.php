<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\User;
use App\Rute;


class TripController extends Controller
{
    public function index(){
    	$trip = Trip::all();
    	return view('erte.trip.index', ['trip' => $trip]);

    }

    public function create(){
        $trip = Trip::all();
        $users = User::all();
        $rute = Rute::all();
        
        return view('erte.trip.create', ['trip' => $trip, 'users' => $users, 'rute' => $rute]);
        
    	
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_trip' => 'required',
            'id_users_operator' => 'required',
            'id_users_sopir' => 'required',
            'id_users_feeder' => 'required',
            'id_rute' => 'required',
            'tanggal' => 'required',
            'jam' => 'required'
            
        ]);

         Trip::create([
            'id_trip' => $request->id_trip,
            'id_users_operator' => $request->id_users_operator,
            'id_users_sopir' => $request->id_users_sopir,
            'id_users_feeder' => $request->id_users_feeder,
            'id_rute' => $request->id_rute,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam
            

        ]);

                session()->flash('flash_success', 'Berhasil menambahkan data trip dengan ID '. $request->input('id_trip')); 

         return redirect('/trip');

    	
    }

    public function edit($id_trip){
    	$trip = Trip::find($id_trip);
        $users = User::all();
        $rute = Rute::all();
        return view('erte.trip.edit', ['trip' => $trip, 'users' => $users, 'rute' => $rute]);
    }

     public function show($id_trip){

        $users = User::find($id_trip);
        $trip = Trip::find($id_trip);
        // $kota = Kota::find($id_trip);
                        
        
        return view('erte.trip.show', ['users' => $users, 'trip' => $trip]);

    }

    public function update($id_trip, Request $request){
    	 $this->validate($request, [
            'id_trip' => 'required',
            'id_users_operator' => 'required',
            'id_users_sopir' => 'required',
            'id_users_feeder' => 'required',
            'id_rute' => 'required',
            'tanggal' => 'required',
            'jam' => 'required']);

            $trip = Trip::find($id_trip);
            $trip->id_trip = $request->id_trip;
            $trip->id_users_operator = $request->id_users_operator;
            $trip->id_users_sopir = $request->id_users_sopir;
            $trip->id_users_feeder = $request->id_users_feeder;
            $trip->id_rute = $request->id_rute;
            $trip->tanggal = $request->tanggal;
            $trip->jam = $request->jam;
            
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
