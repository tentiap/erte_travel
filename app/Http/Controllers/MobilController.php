<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil;
use App\Sopir;
use App\Seat;

class MobilController extends Controller {
    public function index() {
        $mobil = Mobil::orderBy('created_at', 'asc')->paginate(10);
        return view('erte.mobil.index', ['mobil' => $mobil]);
    }

    public function create() {
        $mobil = Mobil::all();
    	$sopir = Sopir::all();

        
    	return view('erte.mobil.create', ['mobil' => $mobil, 'sopir' => $sopir]);
    }

    public function store(Request $request) {
        $this->validate($request, 
            [
    		'plat_mobil' => 'required',
    		'id_sopir' => 'required',
    		'merek_mobil' => 'required',           
        ]);

        $mobil = new Mobil();
        $mobil->plat_mobil = $request->plat_mobil;
        $mobil->id_sopir = $request->id_sopir;
        $mobil->merek_mobil = $request->merek_mobil;
        $mobil->save();

        $id_seat = ["1", "2", "3", "4", "5", "6", "7"];
        $keterangan = ["Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh"];

        for($i=0; $i < count($id_seat); $i++) {
            $seat = new Seat();
            $seat->id_seat = $id_seat[$i];
            $seat->plat_mobil = $mobil->plat_mobil;
            $seat->keterangan = $keterangan[$i];
            $seat->save();
        }

        session()->flash('flash_success', 'Berhasil menambahkan data mobil dengan plat '. $request->input('plat_mobil'));

        return redirect('/mobil');
    }

    public function edit($plat_mobil) {
        $mobil = Mobil::find($plat_mobil);
        $sopir = Sopir::all();
    			    	
    	return view('erte.mobil.edit', ['mobil' => $mobil, 'sopir' => $sopir]);
    }

    public function show($plat_mobil) {
        // $seat = Seat::find($plat_mobil);
        $seat = Seat::where('plat_mobil', $plat_mobil)
        ->orderBy('id_seat', 'asc')->paginate(10);  
        // $mobil = Mobil::find($plat_mobil);
        $mobil = Mobil::where('plat_mobil', $plat_mobil)
        ->first();

        $sopir_select = Sopir::where('id_sopir', $mobil->id_sopir)->get();
        json_decode($sopir_select, true);
        $sopir = ($sopir_select[0]['nama']);
        // dd($sopir);

    
        return view('erte.mobil.show', ['mobil' => $mobil, 'seat' => $seat, "plat_mobil" => $plat_mobil, 'sopir' => $sopir]);
      
    }

    public function update($plat_mobil, Request $request, Mobil $mobil) {
        $this->validate($request, 
            [
            'plat_mobil' => 'required',
            'id_sopir' => 'required',
            'merek_mobil' => 'required',
        ]);

        $mobil = Mobil::find($plat_mobil);
        $mobil->plat_mobil = $request->plat_mobil;
        $mobil->id_sopir = $request->id_sopir;
        $mobil->merek_mobil = $request->merek_mobil;
        $feeder->save();

        session()->flash('flash_success', 'Berhasil mengupdate data mobil '.$mobil->plat_mobil);
        
        return redirect('/mobil');
    }

    public function delete($plat_mobil) {
        $mobil = Mobil::find($plat_mobil);
        $mobil->delete();

        session()->flash('flash_success', "Berhasil menghapus Mobil ".$mobil->plat_mobil);
        return redirect('/feeder');
    }
}
