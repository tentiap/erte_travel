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
        
        $filter_tanggal = '%'.date('Y-m-d', strtotime($request->jadwal)).'%';

        $tripCreated = Trip::where('jadwal', 'like', $filter_tanggal)
                            ->where('plat_mobil', $request->plat_mobil)
                            ->get();
        $jam = date('H:i', strtotime($request->jadwal));
        // dd(count($tripCreated));

        if (count($tripCreated) > 0 ){
            json_decode($tripCreated, true);
            for ($i=0; $i < count($tripCreated); $i++) {
                $tempJadwal = $tripCreated[$i]['jadwal'];
                // ->format('Y-m-d H:i:s')
                // $tempJam = date('H:i', strtotime($tempJadwal));
                // // $selisih = $jam->diff($tempJam)->format('%H:%I:%S');
                // dd(gettype($request->jadwal));
                // dd(gettype($tempJadwal));
                // $difference = $date->diff(Carbon::parse($fromData));
                // $t = Carbon::parse($tempJadwal);
                // dd(gettype($t));

                $selisih_temp = Carbon::parse($request->jadwal)->diff(Carbon::parse($tempJadwal));
                $selisih = $selisih_temp->format('%h');
                // echo (int)$selisih;

                if($selisih < 5) {
                    // print("Selisih kecil dari 5, ".$selisih);
                    session()->flash('flash_danger', 'Ada kemungkinan mobil masih di jalan');
                    return redirect('/trip/create');
                    // echo $selisih->format('%h jam bedanya')."\n";
                    // dd(gettype($selisih->format('%h')));

                } 
                // else {
                //   print("Selisih besar dari 5, ".$selisih);  
                // }
                
            }    
        }
        // elseif(count($tripCreated) == 0 ) {
        //     $newOrderNumber = 1;
        // }

        // dd("Selesai");

        // dd($tripCreated);

        // json_decode($seat_b, true);             
        // $seat_booked = array();
    
        // for ($i=0; $i < $seat_b->count() ; $i++) { 
        //     array_push($seat_booked, $seat_b[$i]['id_seat']);
        // }

        if (Auth::guard('pengurus')->user()->id_pengurus == 'admin') {
            // $filter_tanggal = '%'.date('Y-m-d', strtotime($request->jadwal)).'%';
	    	// $filter_jam = date('H:i', strtotime($request->jadwal));
            // // dd($filter_jam);

            // $lastTripMobil = Trip::where('jadwal', 'like', $filter_tanggal)
            //                     ->where('plat_mobil', '=', $request->plat_mobil)
            //                     ->get();
            // // dd(count($lastTripMobil));
            
            // if(count($lastTripMobil) > 0) {
            //     $jam_last_trip = date('H:i', strtotime($lastTripMobil[0]['jadwal']));;                 
            //     // dd($jam_last_trip);
            //     if($jam_last_trip > $filter_jam) {
            //         dd($jam_last_trip - $filter_jam);
            //         // if(($jam_last_trip - $filter_jam) < 7 ) {
            //         //     session()->flash('flash_danger', 'Kecil dari tujuh');
            //         //     return redirect('/trip/create');

            //         // }
            //     }
            // }
            
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

        $seat = Trip::join('detail_pesanan', ['trip.jadwal' => 'detail_pesanan.jadwal', 'trip.plat_mobil' => 'detail_pesanan.plat_mobil'])
                    ->where(['detail_pesanan.jadwal' => $jadwal, 'detail_pesanan.plat_mobil' => $plat_mobil])
                    ->where('detail_pesanan.status', '!=', 5)
                    ->select('detail_pesanan.id_pemesan','detail_pesanan.id_seat')
                    ->count();
                    // dd($seat);
        
        $string_jadwal = preg_replace('/[^0-9]/', '', date('Y m d', strtotime($jadwal)));
        $id_trip = $string_jadwal.$plat_mobil;

        $sopir_select = Sopir::join('mobil', 'mobil.id_sopir', '=', 'sopir.id_sopir')
                        ->where('mobil.plat_mobil', $plat_mobil)
                        ->select('sopir.nama')
                        ->get();
        json_decode($sopir_select, true);
        $sopir = ($sopir_select[0]['nama']);

        // dd($sopir);

        // $detail = DB::table('detail_pesanan')
        // ->join('pesanan', function ($join) {
        //     $join->on('detail_pesanan.jadwal', '=', 'pesanan.jadwal')->On('detail_pesanan.plat_mobil', '=', 'pesanan.plat_mobil')->On('detail_pesanan.id_pemesan', '=', 'pesanan.id_pemesan.');
        //     })
        // ->join('pemesan', 'pesanan.id_pemesan', '=', 'pemesan.id_pemesan')
        // ->join('trip', ['pesanan.jadwal' => 'trip.jadwal', 'pesanan.plat_mobil' => 'trip.plat_mobil'])
        // ->where('detail_pesanan.id_feeder', $request->id_feeder)
        // ->where('status', '!=', 5)
        // ->select('detail_pesanan.jadwal',
        //         'detail_pesanan.plat_mobil',
        //         'detail_pesanan.id_pemesan',
        //         'detail_pesanan.nama_penumpang',
        //         'detail_pesanan.jenis_kelamin',
        //         'detail_pesanan.id_seat',
        //         'detail_pesanan.detail_asal',
        //         'detail_pesanan.no_hp',
        //         'detail_pesanan.status',
        //         'detail_pesanan.biaya_tambahan',
        //         'pemesan.kontak',
        //         'trip.jadwal')
        // ->orderBy('detail_pesanan.jadwal', 'ASC')
        // ->get();
        
        // $pesanan = Pesanan::with(['detail_pesanan' => function ($query) use($trip) {
        //     $query->where('id_pesanan', '=', $trip);
        // }])->get();

        // $pesanan = Pesanan::with('detail_pesanan'->whereHas('detail_pesanan', function($query) use($trip){
        //     $query->where('id_trip',$trip);
        // }))->get();
        
        return view('erte.trip.show', ['trip' => $trip, 'detail_pesanan' => $detail_pesanan, 'seat' => $seat, 'id_trip' => $id_trip, 'sopir' => $sopir]);

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

    public function update($jadwal, $plat_mobil, Request $request){
    	 $this->validate($request, [
            // 'id_kota_asal' => 'required',
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
        
                        if($selisih < 5) {
                            session()->flash('flash_danger', 'Ada kemungkinan mobil masih di jalan');
                            return redirect('/trip/edit/'.$jadwal.'/'.$plat_mobil);
                        } 
                    }

                }    
            }

            $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
            // $trip->id_trip = $request->id_trip;
            // $trip->id_pengurus = Auth::guard('pengurus')->user()->id_users;
            $trip->jadwal = $request->jadwal;
            $trip->plat_mobil = $request->plat_mobil;
            // $trip->id_kota_asal = $request->id_kota_asal;
            // $trip->id_kota_tujuan = $request->id_kota_tujuan;
            $trip->save();

            session()->flash('flash_success', 'Berhasil mengupdate data trip ');
            return redirect('/trip');
    }

 	public function delete($jadwal, $plat_mobil){
    	$trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
        $trip->delete();

        session()->flash('flash_success', "Berhasil menghapus trip ".$trip->jadwal);
        return redirect('/trip');
    	
    }
}
