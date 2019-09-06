<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feeder;
use App\Users;
use App\Kota;

class FeederController extends Controller
{
    public function index(){
    	$feeder = Feeder::all();
        return view('erte.feeder.index', ['feeder' => $feeder]);
    }

    public function create(){
    	$feeder = Feeder::all();
    	$users = Users::all();
    	$kota = Kota::all();
    	 return view('erte.feeder.create', ['users' => $users, 'feeder' => $feeder, 'kota' => $kota]);
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
    		'id_users' => 'required',
    		'role' => 'required',
    		'username' => 'required',
    		'password' => 'required',
            'email' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'jenis_kelamin' => 'required',
            'id_kota' => 'required',            
        ]);

    	$users = Users::create([
    		'id_users' => $request->id_users,
            'role' => $request->role,
            'username' => $request->username,
            'password' => bcrypt('password'),
            'email' => $request->email,
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'jenis_kelamin' => $request->jenis_kelamin

    	]);

    	$users->feeder()->create($request->only(
    		'id_kota'));

        session()->flash('flash_success', 'Berhasil menambahkan data feeder dengan nama '. $request->input('nama'));

    	return redirect('/feeder');
    }

    public function edit($id_users){

        $users = Users::find($id_users);
    	$feeder = Feeder::find($id_users);
    	// $kota = Kota::find($id_users);
        $kota = Kota::all();
    			    	
    	
    	return view('erte.feeder.edit', ['users' => $users, 'feeder' => $feeder, 'kota' => $kota]);

    }

    public function show($id_users){

        $users = Users::find($id_users);
        $feeder = Feeder::find($id_users);
        $kota = Kota::find($id_users);
                        
        
        return view('erte.feeder.show', ['users' => $users, 'feeder' => $feeder, 'kota' => $kota]);

    }

    public function update($id_users, Request $request, Feeder $feeder){
    	$this->validate($request, 
            [
    		'id_users' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'jenis_kelamin' => 'required',
            'id_kota' => 'required'
            
        ]);


    	// $kota = Feeder::with('kota')->get();

        $users = Users::find($id_users);
        $feeder = Feeder::find($id_users);
        $users->id_users = $request->id_users;
        $users->role = $request->role;
        $users->username = $request->username;
        $users->password = bcrypt('password');
        $users->email = $request->email;
        $users->nama = $request->nama;
        $users->kontak = $request->kontak;
        $users->jenis_kelamin = $request->jenis_kelamin;
        $feeder->id_kota = $request->id_kota;
        
        $users->save();
        $feeder->save();


        session()->flash('flash_success', 'Berhasil mengupdate data feeder '.$users->nama);
        
        return redirect('/feeder');
            
    }

    public function delete($id_users){
    	$feeder = Feeder::find($id_users);
        $users = Users::find($id_users);
    	$feeder->delete();
        $users->delete();

        session()->flash('flash_success', "Berhasil menghapus feeder ".$users->nama);
        return redirect('/feeder');
        
	}



}

