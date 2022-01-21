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
    //    $pengurus = Pengurus::all();
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

        // $tarif_trip = Rute::select('tarif')
        //                 ->where(['id_kota_asal' => $request->id_kota_asal, 'id_kota_tujuan' => $request->id_kota_tujuan])
        //                 ->get();

        $rute = Rute::where(['id_kota_asal' => $request->id_kota_asal, 
                              'id_kota_tujuan' => $request->id_kota_tujuan])
                        ->first();

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

        // $trip = Trip::find($id_trip);
        $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();

        // $pesanan = Pesanan::all();
        // $pesanan = Pesanan::where('id_trip', $id_trip)->get();
        // $pesanan = Pesanan::join('detail_pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
        //             ->select('pesanan.id_trip as pesanan_trip',
        //                      'detail_pesanan.id_seat as detail_seat',
        //                      'detail_pesanan.nama_penumpang as detail_nama')->get();
        $detail_pesanan = Detail_Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                            ->where('status', '!=', '5')
                            ->get();
                            // dd($detail_pesanan);

        $seat = Trip::join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
                    ->where('trip.id_trip', $id_trip)
                    ->where('detail_pesanan.status', '!=', 5)
                    ->select('detail_pesanan.id_pesanan','detail_pesanan.id_seat')
                    ->count();
                    // dd($seat);

                    $detail = DB::table('detail_pesanan')
                    ->join('pesanan', function ($join) {
                        $join->on('detail_pesanan.id_pesanan', '=', 'pesanan.id_pesanan')->On('detail_pesanan.id_trip', '=', 'pesanan.id_trip');
                      })
                    ->join('pemesan', 'pesanan.id_users_pemesan', '=', 'pemesan.id_users')
                    ->join('trip', 'pesanan.id_trip', '=', 'trip.id_trip')
                    ->where('detail_pesanan.id_users_feeder', $request->id_users_feeder)
                    ->where('status', '!=', 5)
                    ->select('detail_pesanan.id_trip',
                             'detail_pesanan.id_pesanan',
                             'detail_pesanan.nama_penumpang',
                             'detail_pesanan.jenis_kelamin',
                             'detail_pesanan.id_seat',
                             'detail_pesanan.detail_asal',
                             'detail_pesanan.no_hp',
                             'detail_pesanan.status',
                             'detail_pesanan.biaya_tambahan',
                             'pemesan.kontak',
                             'trip.jadwal')
                    ->orderBy('jadwal', 'ASC')
                    ->get();
        
        // $pesanan = Pesanan::with(['detail_pesanan' => function ($query) use($trip) {
        //     $query->where('id_pesanan', '=', $trip);
        // }])->get();

        // $pesanan = Pesanan::with('detail_pesanan'->whereHas('detail_pesanan', function($query) use($trip){
        //     $query->where('id_trip',$trip);
        // }))->get();
        
        return view('erte.trip.show', ['trip' => $trip, 'detail_pesanan' => $detail_pesanan, 'seat' => $seat]);

    }

     public function show_cancel($jadwal, $plat_mobil){

        // $trip = Trip::find($id_trip);
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

    // public function update($jadwal, $plat_mobil, Request $request){
    // 	 $this->validate($request, [
    //         'id_kota_asal' => 'required',
    //         'id_kota_tujuan' => 'required',
    //         'jadwal' => 'required']);

    //         $trip = Trip::find($id_trip);
    //         // $trip->id_trip = $request->id_trip;
    //         // $trip->id_pengurus = Auth::guard('pengurus')->user()->id_users;
    //         $trip->id_users_sopir = $request->id_users_sopir;
    //         $trip->id_kota_asal = $request->id_kota_asal;
    //         $trip->id_kota_tujuan = $request->id_kota_tujuan;
    //         $trip->jadwal = $request->jadwal;
            
    //         $trip->save();

    //         session()->flash('flash_success', 'Berhasil mengupdate data trip '.$trip->id_trip);

    //      return redirect('/trip');
    // }

 	public function delete($jadwal, $plat_mobil){
    	$trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
        $trip->delete();

        session()->flash('flash_success', "Berhasil menghapus trip ".$trip->jadwal);
        return redirect('/trip');
    	
    }
}
