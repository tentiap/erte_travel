<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class UsersController extends Controller
{
    public function index(){
    	$users = Users::all();
    	return view('erte.users.index', ['users' => $users]);

    }

    public function create(){
        return view('erte.users.create');
    	
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_users' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'jenis_kelamin' => 'required'
        ]);

         Users::create([
            'id_users' => $request->id_users,
            'role' => $request->role,
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'jenis_kelamin' => $request->jenis_kelamin

        ]);

         return redirect('/users');

    	
    }

    public function edit($id_users){
    	$users = Users::find($id_users);
        return view('erte.users.edit', ['users' => $users]);
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

            $users = Users::find($id_users);
            $users->id_users = $request->id_users;
            $users->role = $request->role;
            $users->username = $request->username;
            $users->password = $request->password;
            $users->email = $request->email;
            $users->nama = $request->nama;
            $users->kontak = $request->kontak;
            $users->jenis_kelamin = $request->jenis_kelamin;
            $users->save();

        

         return redirect('/users');
    }

 	public function delete($id_users){
        $users = Users::find($id_users);
        $users->delete();
        return redirect('/users');
    	
    }   
}
