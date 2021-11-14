<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemesan;

class PemesanController extends Controller
{
    public function index(){
        $pemesan = Pemesan::orderBy('created_at', 'desc')->paginate(10);
        return view('erte.pemesan.index', ['pemesan' => $pemesan]);
    }

    public function create(){
    	$pemesan = Pemesan::all();
     	return view('erte.pemesan.create', ['pemesan' => $pemesan]);
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
    		// 'id_users' => 'required',
    		'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',            
        ]);

         $pemesan = new Pemesan();
            $pemesan_select = Pemesan::select('id_users');
            $pemesan_count = $pemesan_select->count();
                
                if ($pemesan_count === 0) {
                    $pemesan->id_users = 'U1';
                }else{
                    // $lastrow = $trip_select->last();
                    $lastrow=$pemesan_select->orderBy('created_at','desc')->first();
                    $lastrow_id = explode('U', $lastrow->id_users);
                    $new_id = $lastrow_id[1]+1;
                    $pemesan->id_users = 'U'.$new_id;
                }
        $pemesan->username = $request->username;
        $pemesan->email = $request->email;
        $pemesan->password = $request->password;
        $pemesan->nama = $request->nama;
        $pemesan->kontak = $request->kontak;
        $pemesan->jenis_kelamin = $request->jenis_kelamin;
        $pemesan->alamat = $request->alamat;
        $pemesan->save();

        session()->flash('flash_success', 'Berhasil menambahkan data pemesan dengan nama '. $request->input('nama'));

    	return redirect('/pemesan');
    }

    public function store1(Request $request){
        $this->validate($request, 
            [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',            
        ]);

         $pemesan = new Pemesan();
            $pemesan_select = Pemesan::select('id_users');
            $pemesan_count = $pemesan_select->count();
            
                if ($pemesan_count === 0) {
                    $pemesan->id_users = 'U1';
                }else{
                    // $lastrow = $trip_select->last();
                    $lastrow=$pemesan_select->orderBy('created_at','desc')->first();
                    $lastrow_id = explode('U', $lastrow->id_users);
                    $new_id = $lastrow_id[1]+1;
                    $pemesan->id_users = 'U'.$new_id;
                }
        $pemesan->username = $request->username;
        $pemesan->email = $request->email;
        $pemesan->password = $request->password;
        $pemesan->nama = $request->nama;
        $pemesan->kontak = $request->kontak;
        $pemesan->jenis_kelamin = $request->jenis_kelamin;
        $pemesan->alamat = $request->alamat;
        $pemesan->save();

        session()->flash('flash_success', 'Berhasil menambahkan data pemesan dengan nama '. $request->input('nama'));

        return redirect('/pesanan/create');
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
            'username' => 'required',
            'email' => 'required|email',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'alamat' => 'required'
        ]);

        $pemesan = Pemesan::find($id_users);
        $pemesan->username = $request->username;
        $pemesan->email = $request->email;
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
