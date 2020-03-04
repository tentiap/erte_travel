<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemesan;

class PemesanController extends Controller
{
    public function index(){
    	$pemesan = Pemesan::all();
        return view('erte.pemesan.index', ['pemesan' => $pemesan]);
    }

    public function create(){
    	$pemesan = Pemesan::all();
     	return view('erte.pemesan.create', ['pemesan' => $pemesan]);
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
    		'id_users' => 'required',
    		'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',            
        ]);

    	$pemesan = Pemesan::create([
    		'id_users' => $request->id_users,
            // 'role' => $request->role,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat
    	]);

        session()->flash('flash_success', 'Berhasil menambahkan data pemesan dengan nama '. $request->input('nama'));

    	return redirect('/pemesan');
    }

    public function edit($id_users){

    	$pemesan = Pemesan::find($id_users);
    	
       	return view('erte.pemesan.edit', ['pemesan' => $pemesan]);
    }

    public function show($id_users){

        $pemesan = Pemesan::find($id_users);        
        
        return view('erte.pemesan.show', ['pemesan' => $pemesan]);
    }

    public function update($id_users, Request $request, Pemesan $pemesan){
    	$this->validate($request, 
            [
    		'id_users' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'alamat' => 'required'
        ]);

        $pemesan = Pemesan::find($id_users);
        $pemesan->id_users = $request->id_users;
        $pemesan->username = $request->username;
        $pemesan->email = $request->email;
        $pemesan->password = bcrypt('password');
        $pemesan->nama = $request->nama;
        $pemesan->kontak = $request->kontak;
        $pemesan->jenis_kelamin = $request->jenis_kelamin;
        $pemesan->alamat = $request->alamat;
        
        $pemesan->save();

        session()->flash('flash_success', 'Berhasil mengupdate data pemesan '.$pemesan->nama);
        
        return redirect('/pemesan');
    }

    public function delete($id_users){
    	$pemesan = Pemesan::find($id_users);
    	$pemesan->delete();
        session()->flash('flash_success', "Berhasil menghapus pemesan ".$pemesan->nama);
        return redirect('/pemesan');
        
	}
}
