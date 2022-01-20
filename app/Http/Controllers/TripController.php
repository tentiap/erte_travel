<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Trip;
use App\Rute;
use App\Sopir;
use App\Pengurus;
use App\Pesanan;
use App\Kota;
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
       $pengurus = Pengurus::all();
       $sopir = Sopir::all();
       $rute = Rute::all();
       $kota = Kota::all();
        
       return view('erte.trip.create', ['trip' => $trip, 'pengurus' => $pengurus, 'sopir' => $sopir, 'rute' => $rute, 'kota' => $kota]);
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
            'id_kota_asal' => 'required',
            'id_kota_tujuan' => 'required',
            'jadwal' => 'required'
        ]);

        if (Auth::guard('pengurus')->user()->id_users == 'admin') {
            $trip = new Trip();
            $trip_select = Trip::select('id_trip');
            $trip_count = $trip_select->count();
                if ($trip_count === 0) {
                    $trip->id_trip = 'T1';
                }else{
                    $lastrow=$trip_select->orderBy('created_at','desc')->first();
                    $lastrow_id = explode('T', $lastrow->id_trip);
                    $new_id = $lastrow_id[1]+1;
                    $trip->id_trip = 'T'.$new_id;
                }
            $trip->id_users_sopir = $request->id_users_sopir;
            $trip->id_kota_asal = $request->id_kota_asal;
            $trip->id_kota_tujuan = $request->id_kota_tujuan;
            $trip->jadwal = $request->jadwal;
            $trip->save();

            session()->flash('flash_success', 'Berhasil menambahkan data trip'); 
            return redirect('/trip');
        }else{
            if (Auth::guard('pengurus')->user()->id_kota != $request->id_kota_asal) {
                session()->flash('flash_danger', 'Trip berada di luar wilayah operasional pengurus');
                return redirect('/trip/create');
            }else{
                    $trip = new Trip();
                    $trip_select = Trip::select('id_trip');
                    $trip_count = $trip_select->count();
                        if ($trip_count === 0) {
                            $trip->id_trip = 'T1';
                        }else{
                            $lastrow=$trip_select->orderBy('created_at','desc')->first();
                            $lastrow_id = explode('T', $lastrow->id_trip);
                            $new_id = $lastrow_id[1]+1;
                            $trip->id_trip = 'T'.$new_id;
                        }
                $trip->id_users_sopir = $request->id_users_sopir;
                $trip->id_kota_asal = $request->id_kota_asal;
                $trip->id_kota_tujuan = $request->id_kota_tujuan;
                $trip->jadwal = $request->jadwal;
                $trip->save();

                session()->flash('flash_success', 'Berhasil menambahkan data trip'); 
                return redirect('/trip');

            }

        }  
        
    }

    public function edit($id_trip){
    	$trip = Trip::find($id_trip);
        $sopir = Sopir::all();
        $rute = Rute::all();
        $kota = Kota::all();
        
        return view('erte.trip.edit', ['trip' => $trip, 'sopir' => $sopir, 'rute' => $rute, 'kota' => $kota]);
    }

     public function show($id_trip){

        $trip = Trip::find($id_trip);
        // $pesanan = Pesanan::all();
        // $pesanan = Pesanan::where('id_trip', $id_trip)->get();
        // $pesanan = Pesanan::join('detail_pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
        //             ->select('pesanan.id_trip as pesanan_trip',
        //                      'detail_pesanan.id_seat as detail_seat',
        //                      'detail_pesanan.nama_penumpang as detail_nama')->get();
        $detail_pesanan = Detail_Pesanan::where('id_trip', $id_trip)
                            ->where('status', '!=', 5)
                            ->get();
                            // dd($detail_pesanan);

        $seat = Trip::join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
                    ->where('trip.id_trip', $id_trip)
                    ->where('detail_pesanan.status', '!=', 5)
                    ->select('detail_pesanan.id_pesanan','detail_pesanan.id_seat')
                    ->count();
                    // dd($seat);
        
        // $pesanan = Pesanan::with(['detail_pesanan' => function ($query) use($trip) {
        //     $query->where('id_pesanan', '=', $trip);
        // }])->get();

        // $pesanan = Pesanan::with('detail_pesanan'->whereHas('detail_pesanan', function($query) use($trip){
        //     $query->where('id_trip',$trip);
        // }))->get();
        
        return view('erte.trip.show', ['trip' => $trip, 'detail_pesanan' => $detail_pesanan, 'seat' => $seat]);

    }

     public function show_cancel($id_trip){

        $trip = Trip::find($id_trip);
        $detail_pesanan = Detail_Pesanan::where('id_trip', $id_trip)
                            ->where('status', 5)
                            ->get();
                            
        $seat = Trip::join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
                    ->where('trip.id_trip', $id_trip)
                    ->where('detail_pesanan.status', 5)
                    ->select('detail_pesanan.id_pesanan','detail_pesanan.id_seat')
                    ->count();
        
        return view('erte.trip.show_cancel', ['trip' => $trip, 'detail_pesanan' => $detail_pesanan, 'seat' => $seat]);

    }

    public function update($id_trip, Request $request){
    	 $this->validate($request, [
            // 'id_trip' => 'required',
            // 'id_pengurus' => 'required',
            // 'id_sopir' => 'required',
            'id_kota_asal' => 'required',
            'id_kota_tujuan' => 'required',
            'jadwal' => 'required']);

            $trip = Trip::find($id_trip);
            // $trip->id_trip = $request->id_trip;
            // $trip->id_pengurus = Auth::guard('pengurus')->user()->id_users;
            $trip->id_users_sopir = $request->id_users_sopir;
            $trip->id_kota_asal = $request->id_kota_asal;
            $trip->id_kota_tujuan = $request->id_kota_tujuan;
            $trip->jadwal = $request->jadwal;
            
            $trip->save();

            session()->flash('flash_success', 'Berhasil mengupdate data trip '.$trip->id_trip);

         return redirect('/trip');
    }

 	public function delete($id_trip){
        $trip = Trip::find($id_trip);
        $trip->delete();

        session()->flash('flash_success', "Berhasil menghapus trip ".$trip->id_trip);
        return redirect('/trip');
    	
    }
}
