<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operator;
use App\User;
// use App\Role;
use App\Kota;
use Auth;

class OperatorController extends Controller
{
    public function index(){
    	$operator = Operator::all();
        return view('erte.operator.index', ['operator' => $operator]);
    }

    public function create(){
            $operator = Operator::all();
            $users = User::all();
            $kota = Kota::all();
            return view('erte.operator.create', ['users' => $users, 'operator' => $operator, 'kota' => $kota]);
    	
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
    		'id_users' => 'required',
    		// 'role' => 'required',
    		'username' => 'required',
    		'password' => 'required',
            'email' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'jenis_kelamin' => 'required',
            'id_kota' => 'required',            
        ]);

    	$users = User::create([
    		'id_users' => $request->id_users,
            // 'role' => 1,
            'username' => $request->username,
            'password' => bcrypt('password'),
            'email' => $request->email,
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'jenis_kelamin' => $request->jenis_kelamin

    	]);

        // $users->attachRole('operator');

    	$users->operator()->create($request->only(
    		'id_kota'));

        session()->flash('flash_success', 'Berhasil menambahkan data operator dengan nama '. $request->input('nama'));

    	return redirect('/operator');
    }

    public function edit($id_users){

        $users = User::find($id_users);
    	$operator = Operator::find($id_users);
    	// $kota = Kota::find($id_users);
        $kota = Kota::all();
    			    	
    	
    	return view('erte.operator.edit', ['users' => $users, 'operator' => $operator, 'kota' => $kota]);

    }

    public function show($id_users){

        $users = User::find($id_users);
        $operator = Operator::find($id_users);
        $kota = Kota::find($id_users);
                        
        
        return view('erte.operator.show', ['users' => $users, 'operator' => $operator, 'kota' => $kota]);

    }

    public function update($id_users, Request $request, Operator $operator){
    	$this->validate($request, 
            [
    		'id_users' => 'required',
            // 'role' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'jenis_kelamin' => 'required',
            'id_kota' => 'required'
            
        ]);


    	// $kota = Feeder::with('kota')->get();

        $users = User::find($id_users);
        $operator = Operator::find($id_users);
        $users->id_users = $request->id_users;
        // $users->role = 1;
        $users->username = $request->username;
        $users->password = bcrypt('password');
        $users->email = $request->email;
        $users->nama = $request->nama;
        $users->kontak = $request->kontak;
        $users->jenis_kelamin = $request->jenis_kelamin;
        $operator->id_kota = $request->id_kota;
        
        $users->save();
        $operator->save();


        session()->flash('flash_success', 'Berhasil mengupdate data operator '.$users->nama);
        
        return redirect('/operator');
            
    }

    public function delete($id_users){
    	$operator = Operator::find($id_users);
        $users = User::find($id_users);
    	$operator->delete();
        $users->delete();

        session()->flash('flash_success', "Berhasil menghapus operator ".$users->nama);
        return redirect('/operator');
        
	}
}
