<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sopir;

class SopirController extends Controller
{   
    public function index(){

        $sopir = Sopir::orderBy('created_at', 'asc')->paginate(10);

    	// $sopir = Sopir::all();
    	return view('erte.sopir.index', ['sopir' => $sopir]);

    }

    public function create(){

    	$sopir = Sopir::all();
    	 return view('erte.sopir.create', ['sopir' => $sopir]);
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
            
        ]);

        $sopir = new Sopir();
            // $sopir_select = Sopir::select('id_users');
            // $sopir_count = $sopir_select->count();
            //     if ($sopir_count === 0) {
            //         $sopir->id_users = 'S1';
            //     }else{
            //         $lastrow=$sopir_select->orderBy('created_at','desc')->first();
            //         $lastrow_id = explode('S', $lastrow->id_users);
            //         $new_id = $lastrow_id[1]+1;
            //         $sopir->id_users = 'S'.$new_id;
            //     }

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

    public function edit($id_sopir){

    	$sopir = Sopir::find($id_sopir);   			    	
    	
    	return view('erte.sopir.edit', ['sopir' => $sopir]);

    }

    // public function show($id_sopir){

    //     $sopir = Sopir::find($id_sopir);
                                
    //     return view('erte.sopir.show', ['sopir' => $sopir]);

    // }

    public function update($id_sopir, Request $request, Sopir $sopir){
    	$this->validate($request, 
            [
    		// 'id_sopir' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            // 'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);

        $sopir = Sopir::find($id_sopir);
        $sopir->username = $request->username;
        $sopir->email = $request->email;
        $sopir->nama = $request->nama;
        $sopir->kontak = $request->kontak;
        $sopir->jenis_kelamin = $request->jenis_kelamin;
        $sopir->save();

        session()->flash('flash_success', 'Berhasil mengupdate data sopir '.$sopir->nama);
        
        return redirect('/sopir');
     
    }

    public function delete($id_sopir){
    	$sopir = Sopir::find($id_sopir);
    	$sopir->delete();

        session()->flash('flash_success', "Berhasil menghapus sopir ".$sopir->nama);
        return redirect('/sopir');
        
	}


}