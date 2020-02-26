<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemesan;
use App\User;

class PemesanController extends Controller
{
    public function index(){
    	$pemesan = Pemesan::all();
        return view('erte.pemesan.index', ['pemesan' => $pemesan]);
    }

    public function create(){
    	$pemesan = Pemesan::all();
    	$users = User::all();
     	return view('erte.pemesan.create', ['users' => $users, 'pemesan' => $pemesan]);
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
            'alamat' => 'required',            
        ]);

    	$users = User::create([
    		'id_users' => $request->id_users,
            'role' => $request->role,
            'username' => $request->username,
            'password' => bcrypt('password'),
            'email' => $request->email,
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'jenis_kelamin' => $request->jenis_kelamin

    	]);

    	$users->pemesan()->create($request->only(
    		'alamat'));

        session()->flash('flash_success', 'Berhasil menambahkan data pemesan dengan nama '. $request->input('nama'));

    	return redirect('/pemesan');
    }

    public function edit($id_users){

        $users = User::find($id_users);
    	$pemesan = Pemesan::find($id_users);
    	
       	return view('erte.pemesan.edit', ['users' => $users, 'pemesan' => $pemesan]);

    }

    public function show($id_users){

        $users = User::find($id_users);
        $pemesan = Pemesan::find($id_users);               
        
        return view('erte.pemesan.show', ['users' => $users, 'pemesan' => $pemesan]);

    }

    public function update($id_users, Request $request, Pemesan $pemesan){
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
            'alamat' => 'required'
            
        ]);

    	
        $users = User::find($id_users);
        $pemesan = Pemesan::find($id_users);
        $users->id_users = $request->id_users;
        $users->role = $request->role;
        $users->username = $request->username;
        $users->password = bcrypt('password');
        $users->email = $request->email;
        $users->nama = $request->nama;
        $users->kontak = $request->kontak;
        $users->jenis_kelamin = $request->jenis_kelamin;
        $pemesan->alamat = $request->alamat;
        
        $users->save();
        $pemesan->save();


        session()->flash('flash_success', 'Berhasil mengupdate data pemesan '.$users->nama);
        
        return redirect('/pemesan');
            
    }

    public function delete($id_users){
    	$pemesan = Pemesan::find($id_users);
        $users = User::find($id_users);
    	$pemesan->delete();
        $users->delete();

        session()->flash('flash_success', "Berhasil menghapus pemesan ".$users->nama);
        return redirect('/pemesan');
        
	}



}
