<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feeder;

class FeederController extends Controller
{
    public function index(){
    	$feeder = Feeder::all();
        return view('erte.feeder.index', ['feeder' => $feeder]);
    }

    public function create(){
    	$feeder = Feeder::all();
    	$sopir = Sopir::all();
    	// $kota = Kota::all();
    	 return view('erte.feeder.create', ['users' => $users]);
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

}

