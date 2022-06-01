<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sopir;
use App\Mobil;


class SopirController extends Controller
{   
    public function index(){

        $sopir = Sopir::orderBy('created_at', 'asc')->paginate(10);

    	// $sopir = Sopir::all();
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
            // dd("Woi manga ko");
            session()->flash('flash_danger', 'Data Mobil sudah ada');        
            return redirect('/sopir/create');
        } else {
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

    // public function show($id_sopir){

    //     $sopir = Sopir::find($id_sopir);
                                
    //     return view('erte.sopir.show', ['sopir' => $sopir]);

    // }

    public function update($plat_mobil, Request $request, Sopir $sopir){
    	$this->validate($request, 
            [
    		'id_sopir' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            // 'password' => 'required',
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