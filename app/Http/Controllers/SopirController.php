<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Sopir;

class SopirController extends Controller
{
    public function index(){
    	$users = Users::all();
    	$sopir = Sopir::all();
    	return view('erte.sopir.index', ['users' => $users, 'sopir' => $sopir]);

    }

    public function create(){
    	$users = Users::all();
    	$sopir = Sopir::all();
    	 return view('erte.sopir.create', ['users' => $users, 'sopir' => $sopir]);
	}

	public function store(Request $request){
    	$this->validate($request, [
    		'id_rute' => 'required',
    		'id_kota_asal' => 'required',
    		'id_kota_tujuan' => 'required',
    		'harga' => 'required']);

    	$users = Users::create([
    		'id_users' => $request->id_users,
            'role' => $request->role,
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'jenis_kelamin' => $request->jenis_kelamin

    	]);

    	$users->sopir()->create($request->only(
    		'plat_mobil',
    		'merek_mobil'));

    	return redirect('/sopir');
    }

    public function edit($id_users){

        $users = Users::find($id_users);
    	$sopir = Sopir::all;
    			    	
    	
    	return view('erte.sopir.edit', ['users' => $users, 'sopir' => $sopir]);

    }

    public function update($id_users, Request $request){
    	$this->validate($request, [
    		'id_users' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'jenis_kelamin' => 'required']);

    	// $rute = Rute::find($id_rute);
    	// $rute->id_rute = $request->id_rute;
    	// $rute->id_kota_asal = $request->id_kota_asal;
    	// $rute->id_kota_tujuan = $request->id_kota_tujuan;
    	// $rute->save();

        // Flash::success('Kota berhasil ditambahkan');
        // session()->flash('flash_success', 'Berhasil mengupdate data kota '.$kota->nama_kota);
    	// return redirect()->route('kota.index', [$kota->id_kota] );
        return redirect('/rute');
    }

    public function delete($id_rute){
    	$sopir = Sopir::find($id_users);
    	$sopir->delete();
        return redirect('/sopir');
        
	}


}