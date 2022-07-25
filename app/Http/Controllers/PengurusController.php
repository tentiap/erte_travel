<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengurus;
use App\Kota;


class PengurusController extends Controller
{
    public function index(){
        $pengurus = Pengurus::orderBy('created_at', 'asc')->paginate(10);
        return view('erte.pengurus.index', ['pengurus' => $pengurus]);
    }

    public function create(){
            $pengurus = Pengurus::all();
            $kota = Kota::all();
            return view('erte.pengurus.create', ['pengurus' => $pengurus, 'kota' => $kota]);
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
            'id_kota' => 'required',
    		'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required'           
        ]);

        $pengurus = new Pengurus();
            $pengurus_select = Pengurus::select('id_users');
            $pengurus_count = $pengurus_select->count();
                if ($pengurus_count === 1) {
                    $pengurus->id_users = 'O1';
                }else{
                    $lastrow=$pengurus_select->orderBy('created_at','desc')->first();
                    $lastrow_id = explode('O', $lastrow->id_users);
                    $new_id = $lastrow_id[1]+1;
                    $pengurus->id_pengurus = 'O'.$new_id;
                }
        $pengurus->id_kota = $request->id_kota;
        $pengurus->username = $request->username;
        $pengurus->email = $request->email;
        $pengurus->password = $request->password;
        $pengurus->nama = $request->nama;
        $pengurus->kontak = $request->kontak;
        $pengurus->jenis_kelamin = $request->jenis_kelamin;
        $pengurus->save();    

        session()->flash('flash_success', 'Berhasil menambahkan data pengurus dengan nama '. $request->input('nama'));

    	return redirect('/pengurus');
    }

    public function edit($id_users){
    	$pengurus = Pengurus::find($id_users);
        $kota = Kota::all();
    			    	
    	return view('erte.pengurus.edit', ['pengurus' => $pengurus, 'kota' => $kota]);
    }

    public function show($id_users){
        $pengurus = Pengurus::find($id_users);
        $kota = Kota::find($id_users);
        return view('erte.pengurus.show', ['pengurus' => $pengurus, 'kota' => $kota]);
    }

    public function update($id_users, Request $request, Pengurus $pengurus){
    	$this->validate($request, 
            [
            'id_kota' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);

        $pengurus = Pengurus::find($id_pengurus);
        $pengurus->id_kota = $request->id_kota;
        $pengurus->username = $request->username;
        $pengurus->email = $request->email;
        $pengurus->nama = $request->nama;
        $pengurus->kontak = $request->kontak;
        $pengurus->jenis_kelamin = $request->jenis_kelamin;
        $pengurus->save();

        session()->flash('flash_success', 'Berhasil mengupdate data pengurus '.$pengurus->nama);
        return redirect('/pengurus');
    }

    public function delete($id_users){
    	$pengurus = Pengurus::find($id_users);
    	$pengurus->delete();

        session()->flash('flash_success', "Berhasil menghapus pengurus ".$pengurus->nama);
        return redirect('/pengurus');
        
	}
}
