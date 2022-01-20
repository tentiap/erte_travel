<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;

class UsersController extends Controller
{   
    // public function __construct() {
    //     $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    // }


    public function index(){
        // if (Auth::user() != null && Auth::user()->hasRole('pengurus')) {
            $users = User::all();
            return view('erte.users.index', ['users' => $users]);

        // }else{
        //     abort(403, 'Unauthorized action.');
        // }
    	
    }

    public function create(){
        // if (Auth::user()->hasRole('pengurus')) {
            return view('erte.users.create');
        // }else{
        //     return redirect()->back();
        // }
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_users' => 'required|unique:users, id_users',
            // 'role' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'jenis_kelamin' => 'required'
        ]);

         User::create([
            'id_users' => $request->id_users,
            // 'role' => $request->role,
            'username' => $request->username,
            'password' => $request->password,
            // 'password' => bcrypt('password'),
            'email' => $request->email,
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'jenis_kelamin' => $request->jenis_kelamin

        ]);

         return redirect('/users');

    	
    }

    public function edit($id_users){
    	$users = User::find($id_users);
        return view('erte.users.edit', ['users' => $users]);
    }

    public function update($id_users, Request $request){
    	 $this->validate($request, [
            'id_users' => 'required',
            // 'role' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'jenis_kelamin' => 'required']);

            $users = User::find($id_users);
            $users->id_users = $request->id_users;
            // $users->role = $request->role;
            $users->username = $request->username;
            // $users->password = bcrypt('password');
            $users->password = $request->password;
            $users->email = $request->email;
            $users->nama = $request->nama;
            $users->kontak = $request->kontak;
            $users->jenis_kelamin = $request->jenis_kelamin;
            $users->save();

        

         return redirect('/users');
    }

 	public function delete($id_users){
        $users = User::find($id_users);
        $users->delete();
        return redirect('/users');
    	
    }   
}
