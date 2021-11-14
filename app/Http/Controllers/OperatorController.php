<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operator;
use App\Kota;


class OperatorController extends Controller
{
    public function index(){
    	// $operator = Operator::all();
        $operator = Operator::orderBy('created_at', 'asc')->paginate(10);

        return view('erte.operator.index', ['operator' => $operator]);
    }

    public function create(){
            $operator = Operator::all();
            $kota = Kota::all();
            return view('erte.operator.create', ['operator' => $operator, 'kota' => $kota]);
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
    		// 'id_users' => 'required',
            'id_kota' => 'required',
    		'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required'           
        ]);

        $operator = new Operator();
            $operator_select = Operator::select('id_users');
            $operator_count = $operator_select->count();
                if ($operator_count === 1) {
                    $operator->id_users = 'O1';
                }else{
                    $lastrow=$operator_select->orderBy('created_at','desc')->first();
                    $lastrow_id = explode('O', $lastrow->id_users);
                    $new_id = $lastrow_id[1]+1;
                    $operator->id_users = 'O'.$new_id;
                }
        $operator->id_kota = $request->id_kota;
        $operator->username = $request->username;
        $operator->email = $request->email;
        $operator->password = $request->password;
        $operator->nama = $request->nama;
        $operator->kontak = $request->kontak;
        $operator->jenis_kelamin = $request->jenis_kelamin;
        $operator->save();    

        session()->flash('flash_success', 'Berhasil menambahkan data operator dengan nama '. $request->input('nama'));

    	return redirect('/operator');
    }

    public function edit($id_users){

    	$operator = Operator::find($id_users);
        $kota = Kota::all();
    			    	
    	return view('erte.operator.edit', ['operator' => $operator, 'kota' => $kota]);

    }

    public function show($id_users){

        $operator = Operator::find($id_users);
        $kota = Kota::find($id_users);
                        
        
        return view('erte.operator.show', ['operator' => $operator, 'kota' => $kota]);

    }

    public function update($id_users, Request $request, Operator $operator){
    	$this->validate($request, 
            [
            'id_kota' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);

        $operator = Operator::find($id_users);
        $operator->id_kota = $request->id_kota;
        $operator->username = $request->username;
        $operator->email = $request->email;
        $operator->nama = $request->nama;
        $operator->kontak = $request->kontak;
        $operator->jenis_kelamin = $request->jenis_kelamin;
        
        $operator->save();

        session()->flash('flash_success', 'Berhasil mengupdate data operator '.$operator->nama);
        
        return redirect('/operator');
            
    }

    public function delete($id_users){
    	$operator = Operator::find($id_users);
    	$operator->delete();

        session()->flash('flash_success', "Berhasil menghapus operator ".$operator->nama);
        return redirect('/operator');
        
	}
}
