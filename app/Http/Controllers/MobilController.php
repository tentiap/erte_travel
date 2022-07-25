<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil;
use App\Sopir;
use App\Seat;
use App\Trip;

class MobilController extends Controller {
    public function index() {
        $mobil = Mobil::all();
        $sopir = Sopir::all();
        $mobilSopir = Mobil::join('sopir', 'mobil.plat_mobil', '=', 'sopir.plat_mobil')->get();

        return view('erte.mobil.index', ['mobil' => $mobil, 'sopir' => $sopir, 'mobilSopir' => $mobilSopir]);
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
    		'merek_mobil' => 'required'
        ]);

        $mobil = new Mobil();
        $mobil->plat_mobil = $request->plat_mobil;
        $mobil->merek_mobil = $request->merek_mobil;
        $mobil->save();

        session()->flash('flash_success', 'Berhasil menambahkan data mobil dengan plat '. $request->input('plat_mobil'));
        return redirect('/mobil');
    }

    public function edit($plat_mobil) {
        $mobil = Mobil::find($plat_mobil);
        $sopir = Sopir::all();
    			    	
    	return view('erte.mobil.edit', ['mobil' => $mobil, 'sopir' => $sopir]);
    }

    public function update($plat_mobil, Request $request, Mobil $mobil) {
        $this->validate($request, 
            [
            'plat_mobil' => 'required',
            'merek_mobil' => 'required',
        ]);

        $mobil = Mobil::find($plat_mobil);
        $mobil->plat_mobil = $request->plat_mobil;
        $mobil->merek_mobil = $request->merek_mobil;
        $mobil->save();

        session()->flash('flash_success', 'Berhasil mengupdate data mobil '.$mobil->plat_mobil);
        return redirect('/mobil');
    }

    public function delete($plat_mobil) {
        $trip = Trip::where('plat_mobil', $plat_mobil)->get();
        if(!$trip->isEmpty()) {
            session()->flash('flash_danger', "Mobil tidak dapat dihapus, sudah ada trip ");
            return redirect('/mobil');
        } else {
            $mobil = Mobil::find($plat_mobil);
            $mobil->delete();

            session()->flash('flash_success', "Berhasil menghapus Mobil ".$mobil->plat_mobil);
            return redirect('/mobil');
        }
    }
}
