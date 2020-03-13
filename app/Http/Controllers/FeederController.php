<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feeder;
use App\Kota;

class FeederController extends Controller
{
    public function index(){
    	$feeder = Feeder::all();
        return view('erte.feeder.index', ['feeder' => $feeder]);
    }

    public function create(){
    	$feeder = Feeder::all();
    	$kota = Kota::all();
    	 return view('erte.feeder.create', ['feeder' => $feeder, 'kota' => $kota]);
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
    		'id_users' => 'required',
    		'id_kota' => 'required',
    		'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'jenis_kelamin' => 'required'           
        ]);

    	$feeder = Feeder::create([
    		'id_users' => $request->id_users,
            'id_kota' => $request->id_kota,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'jenis_kelamin' => $request->jenis_kelamin
    	]);

        session()->flash('flash_success', 'Berhasil menambahkan data feeder dengan nama '. $request->input('nama'));

    	return redirect('/feeder');
    }

    public function edit($id_users){

    	$feeder = Feeder::find($id_users);
        $kota = Kota::all();
    			    	
    	return view('erte.feeder.edit', ['feeder' => $feeder, 'kota' => $kota]);
    }

    public function show($id_users){

        $feeder = Feeder::find($id_users);
        $kota = Kota::find($id_users);          
        
        return view('erte.feeder.show', ['feeder' => $feeder, 'kota' => $kota]);

    }

    public function update($id_users, Request $request, Feeder $feeder){
    	$this->validate($request, 
            [
    		'id_users' => 'required',
            'id_kota' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        $feeder = Feeder::find($id_users);
        $feeder->id_users = $request->id_users;
        $feeder->id_kota = $request->id_kota;
        $feeder->username = $request->username;
        $feeder->email = $request->email;
        $feeder->password = bcrypt('password');
        $feeder->nama = $request->nama;
        $feeder->kontak = $request->kontak;
        $feeder->jenis_kelamin = $request->jenis_kelamin;
        
        $feeder->save();

        session()->flash('flash_success', 'Berhasil mengupdate data feeder '.$feeder->nama);
        
        return redirect('/feeder');
            
    }

    public function delete($id_users){
    	$feeder = Feeder::find($id_users);
    	$feeder->delete();

        session()->flash('flash_success', "Berhasil menghapus feeder ".$feeder->nama);
        return redirect('/feeder');
        
	}



}

