<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Trip;
use App\Rute;
use App\Sopir;
use App\Pesanan;
use App\Kota;
use App\Mobil;
use App\Detail_Pesanan;
use Carbon\Carbon;
use Auth;


class TripController extends Controller
{
    public function index(){
        if (Auth::guard('pengurus')->user()->id_pengurus == 'admin') {
            $trip = Trip::orderBy('jadwal', 'desc')->paginate(10);
            return view('erte.trip.index', ['trip' => $trip]);
        }else{
            $kota = Auth::guard('pengurus')->user()->id_kota;
            $trip = Trip::where('id_kota_asal', $kota)
                        ->orderBy('jadwal', 'desc')->paginate(10);
            return view('erte.trip.index', ['trip' => $trip]);
        }    
    }

    public function create(){
       $trip = Trip::all();
       $mobil = Mobil::all();
       $rute = Rute::all();
       $kota = Kota::all();
        
       return view('erte.trip.create', ['trip' => $trip, 'mobil' => $mobil, 'rute' => $rute, 'kota' => $kota]);
    }

    public function getKotaTujuan(){
        $id_kota_a = Input::get('id_kota_asal');
        $rute = Rute::with("kota_tujuan")->whereHas("kota_asal",function($query) use($id_kota_a){
            $query->where("id_kota","=",$id_kota_a);
        })->get();

        return response()->json($rute);        
    }

    public function store(Request $request){
        $this->validate($request, [
            'jadwal' => 'required',
            'plat_mobil' => 'required',
            'id_kota_asal' => 'required',
            'id_kota_tujuan' => 'required',
        ]);

        $rute = Rute::where(['id_kota_asal' => $request->id_kota_asal, 
                              'id_kota_tujuan' => $request->id_kota_tujuan])
                        ->first();
        
        $filter_tanggal = '%'.date('Y-m-d', strtotime($request->jadwal)).'%';

        $tripCreated = Trip::where('jadwal', 'like', $filter_tanggal)
                            ->where('plat_mobil', $request->plat_mobil)
                            ->get();
        $jam = date('H:i', strtotime($request->jadwal));

        if (count($tripCreated) > 0 ){
            json_decode($tripCreated, true);
            for ($i=0; $i < count($tripCreated); $i++) {
                $tempJadwal = $tripCreated[$i]['jadwal'];
                $selisih_temp = Carbon::parse($request->jadwal)->diff(Carbon::parse($tempJadwal));
                $selisih = $selisih_temp->format('%h');

                if($selisih < 5) {
                    session()->flash('flash_danger', 'Ada kemungkinan mobil masih di jalan');
                    return redirect('/trip/create');
                } 
            }    
        }

        if (Auth::guard('pengurus')->user()->id_pengurus == 'admin') {        
            $trip = Trip::create([
                'jadwal' => $request->jadwal,
                'plat_mobil' => $request->plat_mobil,
                'id_kota_asal' => $request->id_kota_asal,
                'id_kota_tujuan' => $request->id_kota_tujuan,
                'tarif_trip' => $rute->tarif
            ]);
        
            session()->flash('flash_success', 'Berhasil menambahkan data trip'); 
            return redirect('/trip');
        }else{
            if (Auth::guard('pengurus')->user()->id_kota != $request->id_kota_asal) {
                session()->flash('flash_danger', 'Trip berada di luar wilayah operasional pengurus');
                return redirect('/trip/create');
            }else{
                $trip = Trip::create([
                    'jadwal' => $request->jadwal,
                    'plat_mobil' => $request->plat_mobil,
                    'id_kota_asal' => $request->id_kota_asal,
                    'id_kota_tujuan' => $request->id_kota_tujuan,
                    'tarif_trip' => $rute->tarif
                ]);
            
                session()->flash('flash_success', 'Berhasil menambahkan data trip'); 
                return redirect('/trip');
            }
        }  
    }

    public function edit($jadwal, $plat_mobil){
        $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
        $sopir = Sopir::all();
        $rute = Rute::all();
        $kota = Kota::all();
        $mobil = Mobil::all();
        
        return view('erte.trip.edit', ['trip' => $trip, 'sopir' => $sopir, 'rute' => $rute, 'kota' => $kota, 'mobil' => $mobil]);
    }

     public function show($jadwal, $plat_mobil){
        $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
        $detail_pesanan = Detail_Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                            ->where('status', '!=', '5')
                            ->get();

        $seat = Trip::join('detail_pesanan', ['trip.jadwal' => 'detail_pesanan.jadwal', 'trip.plat_mobil' => 'detail_pesanan.plat_mobil'])
                    ->where(['detail_pesanan.jadwal' => $jadwal, 'detail_pesanan.plat_mobil' => $plat_mobil])
                    ->where('detail_pesanan.status', '!=', 5)
                    ->select('detail_pesanan.id_pemesan','detail_pesanan.id_seat')
                    ->count();
        
        $string_jadwal = preg_replace('/[^0-9]/', '', date('Y m d', strtotime($jadwal)));
        $id_trip = $string_jadwal.$plat_mobil;

        return view('erte.trip.show', ['trip' => $trip, 'detail_pesanan' => $detail_pesanan, 'seat' => $seat, 'id_trip' => $id_trip]);
    }

     public function show_cancel($jadwal, $plat_mobil){
        $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
        $detail_pesanan = Detail_Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                            ->where('status', 5)
                            ->get();
                            
        $seat = Trip::join('pesanan', )
                    ->join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
                    ->where('trip.id_trip', $id_trip)
                    ->where('detail_pesanan.status', 5)
                    ->select('detail_pesanan.id_pesanan','detail_pesanan.id_seat')
                    ->count();
        
        return view('erte.trip.show_cancel', ['trip' => $trip, 'detail_pesanan' => $detail_pesanan, 'seat' => $seat]);
    }

    public function update($jadwal, $plat_mobil, Request $request){
    	 $this->validate($request, [
            'plat_mobil' => 'required',
            'jadwal' => 'required']);

            $filter_tanggal = '%'.date('Y-m-d', strtotime($jadwal)).'%';

            $tripCreated = Trip::where('jadwal', 'like', $filter_tanggal)
                                ->where('plat_mobil', $plat_mobil)
                                ->get();
            $jam = date('H:i', strtotime($jadwal));

            if (count($tripCreated) > 0 ){
                json_decode($tripCreated, true);
                for ($i=0; $i < count($tripCreated); $i++) {
                    $tempJadwal = $tripCreated[$i]['jadwal'];
                    if($jadwal != $tempJadwal ) {
                        $selisih_temp = Carbon::parse($request->jadwal)->diff(Carbon::parse($tempJadwal));
                        $selisih = $selisih_temp->format('%h');
        
                        if($selisih < 5.0) {
                            session()->flash('flash_danger', 'Ada kemungkinan mobil masih di jalan');
                            return redirect('/trip/edit/'.$jadwal.'/'.$plat_mobil);
                        } 
                    } 
                }    
            }

            $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
            $trip->jadwal = $request->jadwal;
            $trip->plat_mobil = $request->plat_mobil;
            $trip->save();

            session()->flash('flash_success', 'Berhasil mengupdate data trip ');
            return redirect('/trip');
    }

 	public function delete($jadwal, $plat_mobil){
        $pesanan = Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->get();

        if(!$pesanan->isEmpty()){
            session()->flash('flash_danger', "Trip tidak dapat dihapus, sudah ada pesanan ");
        } else {
            $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
            $trip->delete();

            session()->flash('flash_success', "Berhasil menghapus trip ".$trip->jadwal);
        }
        return redirect('/trip');
    }
}
