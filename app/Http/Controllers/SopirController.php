<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Sopir;

class SopirController extends Controller
{   
    // public $validation_rules = [
    //        'id_users' => 'required',
    //         'role' => 'required',
    //         'username' => 'required',
    //         'password' => 'required',
    //         'email' => 'required',
    //         'nama' => 'required',
    //         'kontak' => 'required',
    //         'jenis_kelamin' => 'required',
    //         'plat_mobil' => 'required|unique:sopir,plat_mobil',
    //         'merek_mobil' => 'required', 
    // ];

    public function index(){
    	// $users = Users::all();
    	$sopir = Sopir::all();
    	// return view('erte.sopir.index', ['users' => $users, 'sopir' => $sopir]);
        return view('erte.sopir.index', ['sopir' => $sopir]);

    }

    public function create(){
    	$users = Users::all();
    	$sopir = Sopir::all();
    	 return view('erte.sopir.create', ['users' => $users, 'sopir' => $sopir]);
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
            'plat_mobil' => 'required|unique:sopir,plat_mobil',
            'merek_mobil' => 'required',
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

    	$users->sopir()->create($request->only(
    		'plat_mobil',
    		'merek_mobil'));

        session()->flash('flash_success', 'Berhasil menambahkan data sopir dengan nama '. $request->input('nama'));

    	return redirect('/sopir');
    }

    public function edit($id_users){

        $users = Users::find($id_users);
    	$sopir = Sopir::find($id_users);
    			    	
    	
    	return view('erte.sopir.edit', ['users' => $users, 'sopir' => $sopir]);

    }

    public function show($id_users){

        $users = Users::find($id_users);
        $sopir = Sopir::find($id_users);
                        
        
        return view('erte.sopir.show', ['users' => $users, 'sopir' => $sopir]);

    }

    public function update($id_users, Request $request, Sopir $sopir){
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
            'plat_mobil' => 'required',
            'merek_mobil' => 'required'
        ]);


    	// $sopir->users->update([
     //        'id_users' => $request->id_users,
     //        'role' => $request->role,
     //        'username' => $request->username,
     //        'password' => $request->password,
     //        'email' => $request->email,
     //        'nama' => $request->nama,
     //        'kontak' => $request->kontak,
     //        'jenis_kelamin' => $request->jenis_kelamin

     //    ]);

        // $users->sopir()->update($request->only(
        //     'plat_mobil',
        //     'merek_mobil'));

        $users = Users::find($id_users);
        $sopir = Sopir::find($id_users);
        $users->id_users = $request->id_users;
        $users->role = $request->role;
        $users->username = $request->username;
        $users->password = bcrypt('password');
        $users->email = $request->email;
        $users->nama = $request->nama;
        $users->kontak = $request->kontak;
        $users->jenis_kelamin = $request->jenis_kelamin;
        $sopir->plat_mobil = $request->plat_mobil;
        $sopir->merek_mobil = $request->merek_mobil;
        $users->save();
        $sopir->save();


        session()->flash('flash_success', 'Berhasil mengupdate data sopir '.$users->nama);
        
        return redirect('/sopir');

        
     
    }

    public function delete($id_users){
    	$sopir = Sopir::find($id_users);
        $users = Users::find($id_users);
    	$sopir->delete();
        $users->delete();

        session()->flash('flash_success', "Berhasil menghapus sopir ".$users->nama);
        return redirect('/sopir');
        
	}


}