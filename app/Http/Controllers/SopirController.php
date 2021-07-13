<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    		// 'id_users' => 'required',
            'plat_mobil' => 'required|unique:sopir,plat_mobil',
            'merek_mobil' => 'required',
    		'username' => 'required',
            'email' => 'required|email',
    		'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required',
            
        ]);

        $sopir = new Sopir();
            $sopir_select = Sopir::select('id_users');
            $sopir_count = $sopir_select->count();
                // if ($operator_count === 1 && $operator->id_users === "admin" ) {
                if ($sopir_count === 0) {
                    $sopir->id_users = 'S1';
                }else{
                    // $lastrow = $trip_select->last();
                    $lastrow=$sopir_select->orderBy('created_at','desc')->first();
                    $lastrow_id = explode('S', $lastrow->id_users);
                    $new_id = $lastrow_id[1]+1;
                    $sopir->id_users = 'S'.$new_id;
                }

        $sopir->plat_mobil = $request->plat_mobil;
        $sopir->merek_mobil = $request->merek_mobil;
        $sopir->username = $request->username;
        $sopir->email = $request->email;
        $sopir->password = $request->password;
        $sopir->nama = $request->nama;
        $sopir->kontak = $request->kontak;
        $sopir->jenis_kelamin = $request->jenis_kelamin;
        $sopir->save();

    	// $sopir = Sopir::create([
    	// 	'id_users' => $request->id_users,
     //        'plat_mobil' => $request->plat_mobil,
     //        'merek_mobil' => $request->merek_mobil,
     //        'username' => $request->username,
     //        'email' => $request->email,
     //        'password' => bcrypt('password'),
     //        'nama' => $request->nama,
     //        'kontak' => $request->kontak,
     //        'jenis_kelamin' => $request->jenis_kelamin

    	// ]);

        session()->flash('flash_success', 'Berhasil menambahkan data sopir dengan nama '. $request->input('nama'));

    	return redirect('/sopir');
    }

    public function edit($id_users){

    	$sopir = Sopir::find($id_users);   			    	
    	
    	return view('erte.sopir.edit', ['sopir' => $sopir]);

    }

    public function show($id_users){

        $sopir = Sopir::find($id_users);
                                
        return view('erte.sopir.show', ['sopir' => $sopir]);

    }

    public function update($id_users, Request $request, Sopir $sopir){
    	$this->validate($request, 
            [
    		// 'id_users' => 'required',
            'plat_mobil' => 'required',
            'merek_mobil' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            // 'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);

        $sopir = Sopir::find($id_users);
        // $sopir->id_users = $request->id_users;
        $sopir->plat_mobil = $request->plat_mobil;
        $sopir->merek_mobil = $request->merek_mobil;
        $sopir->username = $request->username;
        $sopir->email = $request->email;
        $sopir->nama = $request->nama;
        $sopir->kontak = $request->kontak;
        $sopir->jenis_kelamin = $request->jenis_kelamin;
        $sopir->save();

        session()->flash('flash_success', 'Berhasil mengupdate data sopir '.$sopir->nama);
        
        return redirect('/sopir');
     
    }

    public function delete($id_users){
    	$sopir = Sopir::find($id_users);
    	$sopir->delete();

        session()->flash('flash_success', "Berhasil menghapus sopir ".$sopir->nama);
        return redirect('/sopir');
        
	}


}