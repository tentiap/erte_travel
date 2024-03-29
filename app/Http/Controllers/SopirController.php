<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sopir;
use App\Mobil;


class SopirController extends Controller
{   
    public function index(){
        $sopir = Sopir::orderBy('created_at', 'asc')->paginate(10);
    	return view('erte.sopir.index', ['sopir' => $sopir]);
    }

    public function create(){
    	$sopir = Sopir::all();
        $mobil = Mobil::all();
    	return view('erte.sopir.create', ['sopir' => $sopir, 'mobil' => $mobil]);
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
    		'id_sopir' => 'required',
    		'username' => 'required',
            'email' => 'required|email',
    		'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'plat_mobil' => 'required'
            
        ]);

        if (Sopir::where('plat_mobil', $request->plat_mobil)->exists()){
            session()->flash('flash_danger', 'Data Mobil sudah ada');        
            return redirect('/sopir/create');
        } else {
            $sopir = new Sopir();
            $sopir->plat_mobil = $request->plat_mobil;
            $sopir->id_sopir = $request->id_sopir;
            $sopir->username = $request->username;
            $sopir->email = $request->email;
            $sopir->password = $request->password;
            $sopir->nama = $request->nama;
            $sopir->kontak = $request->kontak;
            $sopir->jenis_kelamin = $request->jenis_kelamin;
            $sopir->save();

            session()->flash('flash_success', 'Berhasil menambahkan data sopir dengan nama '. $request->input('nama'));
            return redirect('/sopir');
        }
       
    }

    public function edit($plat_mobil){
    	$sopir = Sopir::find($plat_mobil); 
        $mobil = Mobil::all();  			    	
    	
    	return view('erte.sopir.edit', ['sopir' => $sopir, 'mobil' => $mobil]);
    }

    public function update($plat_mobil, Request $request, Sopir $sopir){
    	$this->validate($request, 
            [
    		'id_sopir' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);

        $sopir = Sopir::find($plat_mobil);
        $sopir->plat_mobil = $request->plat_mobil;
        $sopir->id_sopir = $request->id_sopir;
        $sopir->username = $request->username;
        $sopir->email = $request->email;
        $sopir->nama = $request->nama;
        $sopir->kontak = $request->kontak;
        $sopir->jenis_kelamin = $request->jenis_kelamin;
        $sopir->save();

        session()->flash('flash_success', 'Berhasil mengupdate data sopir '.$sopir->nama);
        return redirect('/sopir');
    }

    public function delete($plat_mobil){
    	$sopir = Sopir::find($plat_mobil);
    	$sopir->delete();

        session()->flash('flash_success', "Berhasil menghapus sopir ".$sopir->nama);
        return redirect('/sopir');   
	}
}