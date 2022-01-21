<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use App\Pesanan;
use App\Trip;
use App\Pemesan;
use App\Feeder;
use App\Pengurus;
use App\Detail_Pesanan;
use App\Kota;
use App\Seat;
use App\Mobil;
use DateTime;
use Carbon\Carbon;

class PesananController extends Controller
{
    public function index(){
        if (Auth::guard('pengurus')->user()->id_users == 'admin') {
        
            // $pesanan = Pesanan::join('trip', 'pesanan.jadwal', '=', 'trip.id_trip')
            //                         ->orderBy('pesanan.tanggal_pesan', 'desc')->paginate(10);
            $pesanan = DB::table('pesanan')
                            ->join('trip', function ($join) {
                                $join->on('pesanan.jadwal', '=', 'trip.jadwal')->On('pesanan.plat_mobil', '=', 'trip.plat_mobil');
                            })
                            ->orderBy('pesanan.tanggal_pesan', 'desc')->paginate(10);
            $trip = Trip::all();
            $pemesan = Pemesan::all();
            $pengurus = Pengurus::all();
            $mobil = Mobil::all();

            return view('erte.pesanan.index', ['pesanan' => $pesanan, 'trip' => $trip,  'pemesan' => $pemesan, 'pengurus' => $pengurus, 'mobil' => $mobil]);

        }else{

            $kota = Auth::guard('pengurus')->user()->id_kota;
            // $pesanan = Pesanan::join('trip', 'pesanan.id_trip', '=', 'trip.id_trip')
            //             ->where('trip.id_kota_asal',  $kota)
            //             ->orderBy('trip.jadwal', 'desc')->paginate(10);
            $pesanan = DB::table('pesanan')
                            ->join('trip', function ($join) {
                                $join->on('pesanan.jadwal', '=', 'trip.jadwal')->On('pesanan.plat_mobil', '=', 'trip.plat_mobil');
                            })
                            ->where('trip.id_kota_asal', $kota)
                            ->orderBy('pesanan.tanggal_pesan', 'desc')->paginate(10);
            $trip = Trip::all();
            $pemesan = Pemesan::all();
            $pengurus = Pengurus::all();
            $mobil = Mobil::all();

            return view('erte.pesanan.index', ['pesanan' => $pesanan, 'trip' => $trip,  'pemesan' => $pemesan, 'pengurus' => $pengurus, 'mobil' => $mobil]);
        }    
    }


    public function create(){
    	$pesanan = Pesanan::all();
    	$trip = Trip::all();
    	$pemesan = Pemesan::all();
        $kota = Kota::all();
        $seat = Seat::all();
    	
     	return view('erte.pesanan.create', ['pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan, 'kota' => $kota, 'seat' => $seat]);
	}

    public function search(){

            $id_kota_asal = Input::get('id_kota_asal');
            $id_kota_tujuan = Input::get('id_kota_tujuan');
            $tanggal = Input::get('tanggal');
            $filter = '%'.$tanggal.'%';
            $jumlah_penumpang = Input::get('jumlah_penumpang');
            $p = Input::get('id_users_pemesan');
            $pemesan = Pemesan::where('id_users', $p)->get();
            $today = Carbon::now();
            $filter_today = date('Y-m-d H:i:s', strtotime($today));
       
        if (Auth::guard('pengurus')->user()->id_users == 'admin') {
            $trip_a = Trip::where(['id_kota_asal' => $id_kota_asal, 
                               'id_kota_tujuan' => $id_kota_tujuan,])
                    ->where('jadwal', 'like', $filter)
                    ->where('jadwal', '>', $filter_today)
                    ->orderBy('trip.jadwal', 'asc')
                    ->get(); 
                

            $seat_a = Trip::join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
                            ->where(['id_kota_asal' => $id_kota_asal, 
                                       'id_kota_tujuan' => $id_kota_tujuan,])
                            ->where('jadwal', 'like', $filter)
                            ->where('detail_pesanan.status', '!=', 5)
                            ->select('detail_pesanan.id_seat')
                            ->count();
                            
              
            $seat = ($trip_a->count() * 7) - $seat_a;

                      
            if(!$trip_a->isEmpty() && $seat >= $jumlah_penumpang){

                    return view('erte.pesanan.search', ['trip_a' => $trip_a, 'id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan, 'tanggal' => $tanggal, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat, 'pemesan' => $pemesan, 'seat_a' => $seat_a]);
            }else{
                    session()->flash('flash_danger', 'Tidak ada trip');
                    return redirect('/pesanan/create');
            }

        }else{
            if (Auth::guard('pengurus')->user()->id_kota != $id_kota_asal) {
                session()->flash('flash_danger', 'Pesanan berada di luar wilayah operasional pengurus');
                return redirect('/pesanan/create');
            }else{
            
                $trip_a = Trip::where(['id_kota_asal' => $id_kota_asal, 
                               'id_kota_tujuan' => $id_kota_tujuan,])
                    ->where('jadwal', 'like', $filter)
                    ->where('jadwal', '>', $filter_today)
                    ->get(); 
   
                $seat_a = Trip::join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
                            ->where(['id_kota_asal' => $id_kota_asal, 
                                       'id_kota_tujuan' => $id_kota_tujuan,])
                            ->where('jadwal', 'like', $filter)
                            ->where('jadwal', '>', $filter_today)
                            ->where('detail_pesanan.status', '!=', 5)
                            ->select('detail_pesanan.id_seat')
                            ->count();

                $seat = ($trip_a->count() * 7) - $seat_a;
                      
                if(!$trip_a->isEmpty() && $seat >= $jumlah_penumpang){

                    return view('erte.pesanan.search', ['trip_a' => $trip_a, 'id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan, 'tanggal' => $tanggal, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat, 'pemesan' => $pemesan, 'seat_a' => $seat_a]);
                }else{
                    session()->flash('flash_danger', 'Tidak ada trip');
                    return redirect('/pesanan/create');
                }   
        }

    }
        
        
    }

    public function getTrip(){
        $id_kota_a = Input::get('id_kota_asal');
        $id_kota_t = Input::get('id_kota_tujuan');               
        $tes = Trip::select('jadwal')
                ->where(['id_kota_asal' => $id_kota_a, 'id_kota_tujuan' => $id_kota_t])
                ->whereDate('jadwal', '>', Carbon::now())
                ->get();
    }

    public function detail($jumlah_penumpang, $id_trip, $id_users_pemesan){

        if (Pesanan::where(['id_trip' => $id_trip, 'id_users_pemesan' => $id_users_pemesan])->
                    exists()){
            
            session()->flash('flash_danger', 'Data pemesan di trip ini sudah ada');
            return redirect('/pesanan');

        }else{

            $trip = Trip::where(['id_trip' => $id_trip])->get();
            $jumlah_penumpang = $jumlah_penumpang;
            $pemesan = Pemesan::where('id_users', $id_users_pemesan)->get();
            $seat = Seat::all();
            $seat_b = Detail_Pesanan::where('id_trip', $id_trip)
                        ->where('status', '!=', 5)
                        ->orderBy('id_seat', 'ASC')
                        ->get();
            $seat_tersedia = 7 - ($seat_b->count());
            
            if($seat_tersedia == 0){
                session()->flash('flash_danger', 'Trip ini sudah penuh');
                return redirect('/pesanan/create');
            }else if($seat_tersedia >= $jumlah_penumpang){
                json_decode($seat_b, true);
                $seat_booked = array();
                

                for ($i=0; $i < $seat_b->count() ; $i++) { 
                    array_push($seat_booked, $seat_b[$i]['id_seat']);
                }

                return view('erte.pesanan.detail', ['trip' => $trip, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat, 'pemesan' => $pemesan, 'seat_b' => $seat_b, 'seat_booked' => $seat_booked]);    
            }else if($seat_tersedia < $jumlah_penumpang){
                session()->flash('flash_danger', 'Hanya ' .$seat_tersedia. ' seat yang tersedia');
                return redirect('/pesanan/create');
            }
        }
             
    }

    public function update_detail($id_pesanan, $id_trip, $id_users_pemesan){

            $jumlah_penumpang = Input::get('jumlah_penumpang');
            $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
            $trip = Trip::where(['id_trip' => $id_trip])->get();
           
            $pemesan = Pemesan::where('id_users', $id_users_pemesan)->get();
            $seat = Seat::all();
            $seat_b = Detail_Pesanan::where('id_trip', $id_trip)
                        ->where('status', '!=', 5)
                        ->orderBy('id_seat', 'ASC')
                        ->get();
            $seat_tersedia = 7 - ($seat_b->count());    
        
        return view('erte.pesanan.update_detail', ['trip' => $trip, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat, 'pemesan' => $pemesan, 'seat_b' => $seat_b, 'seat_tersedia' => $seat_tersedia, 'pesanan' => $pesanan]);
    }

    public function store($jumlah_penumpang, $id_trip, $id_users_pemesan, Request $request){
        $this->validate($request, 
            [
            'nama_penumpang' => 'required',
            'jenis_kelamin' => 'required',
            'id_seat' => 'required',
            'detail_asal' => 'required',
            'detail_tujuan' => 'required'            
        ]);
                if (count($request->id_seat) > 0) {
                    $requestedSeat = array();
                    for ($i=0; $i < count($request->id_seat); $i++) { 
                            if (Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $request->id_seat[$i]])->where('status', '!=', 5)->exists()) {
                                session()->flash('flash_danger', 'Seat ' .$request->id_seat[$i]. ' sudah dibooking');
                                echo redirect('/pesanan/create_detail/'.$jumlah_penumpang. '/' .$id_trip. '/' .$id_users_pemesan);
                            }elseif (in_array($request->id_seat[$i], $requestedSeat) == false){
                                array_push($requestedSeat, $request->id_seat[$i]);
                            }elseif (in_array($request->id_seat[$i], $requestedSeat) == true){
                                session()->flash('flash_danger', 'Seat ' .$request->id_seat[$i]. ' tidak bisa diisi lebih dari 1 orang');
                                return redirect('/pesanan/create_detail/'.$jumlah_penumpang. '/' .$id_trip. '/' .$id_users_pemesan);
                            }       
                    }
                }

                $pesanan = new Pesanan();
                    $pesanan_select = Pesanan::select('id_pesanan');
                    $pesanan_count = $pesanan_select->count();
                        if ($pesanan_count === 0) {
                            $pesanan->id_pesanan = 'P1';
                        }else{
                            $lastrow=$pesanan_select->orderBy('tanggal_pesan','desc')->first();
                            $lastrow_id = explode('P', $lastrow->id_pesanan);
                            $new_id = $lastrow_id[1]+1;
                            $pesanan->id_pesanan = 'P'.$new_id;
                        }
                $pesanan->id_trip = $id_trip;
                $pesanan->id_users_pemesan = $id_users_pemesan;            
                $pesanan->tanggal_pesan = date('Y-m-d H:i:s');
                $pesanan->id_pengurus = Auth::guard('pengurus')->user()->id_pengurus;
                $pesanan->save();

                foreach($request->id_seat as $key => $value){
                    Detail_Pesanan::create([
                        'id_trip' => $pesanan->id_trip,
                        'id_seat' => $request->id_seat[$key],
                        'id_pesanan' => $pesanan->id_pesanan,
                        'nama_penumpang' => $request->nama_penumpang[$key],
                        'jenis_kelamin' => $request->jenis_kelamin[$key],
                        'detail_asal' => $request->detail_asal[$key],
                        'detail_tujuan' => $request->detail_tujuan[$key],
                        'no_hp' => $request->no_hp[$key],
                        'biaya_tambahan' => 0,
                        'status' => 1
                    ]);
                }

                session()->flash('flash_success', 'Berhasil menambahkan data pesanan ');
                return redirect('/pesanan');    

    }

    public function update_store($jumlah_penumpang, $id_pesanan, $id_trip, $id_users_pemesan, Request $request){
        $this->validate($request, 
            [
            // 'id_users' => 'required',
            'nama_penumpang' => 'required',
            'jenis_kelamin' => 'required',
            'id_seat' => 'required',
            'detail_asal' => 'required',
            'detail_tujuan' => 'required'            
        ]);

        $trip = Trip::where(['id_trip' => $id_trip])->get();

        if(Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $request->id_seat])
                ->where('status', '!=', 5)
                ->exists()) {
                        
                    session()->flash('flash_danger', 'Seat sudah dibooking');
                    return redirect('/pesanan/edit');
        }else{
            foreach($request->nama_penumpang as $key => $value){
                    Detail_Pesanan::create([
                        'id_trip' => $id_trip,
                        'id_seat' => $request->id_seat[$key],
                        'id_pesanan' => $id_pesanan,
                        'nama_penumpang' => $request->nama_penumpang[$key],
                        'jenis_kelamin' => $request->jenis_kelamin[$key],
                        'detail_asal' => $request->detail_asal[$key],
                        'detail_tujuan' => $request->detail_tujuan[$key],
                        'no_hp' => $request->no_hp[$key],
                        'biaya_tambahan' => $request->biaya_tambahan[$key],
                        'status' => 1
                    ]);
                }

                session()->flash('flash_success', 'Berhasil menambahkan data penumpang' );
                return redirect('/pesanan/show/' .$id_pesanan. '/' .$id_trip);

        }             

                
    }

    public function edit($id_pesanan, $id_trip){
    	$pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
        $detail = Detail_Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->orderBy('id_seat', 'ASC')->get();
        $jumlah = $detail->count();
        $kota = Kota::all();

    	$trip = Trip::find($id_trip);

    	$pemesan = Pemesan::all();
        $seat = Seat::all();
        $feeder = Feeder::where('id_kota', $trip->id_kota_asal)->get();

        $seat_b = Detail_Pesanan::where('id_trip', $id_trip)
                        ->where('status', '!=', 5)
                        // ->select('id_seat')
                        ->orderBy('id_seat', 'ASC')
                        ->get();

         json_decode($seat_b, true);
                $seat_booked = array();
    
                for ($i=0; $i < $seat_b->count() ; $i++) { 
                    array_push($seat_booked, $seat_b[$i]['id_seat']);
                }


        return view('erte.pesanan.edit', ['pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan, 'seat' => $seat, 'detail' => $detail, 'jumlah' => $jumlah, 'kota' => $kota, 'seat_b' => $seat_b, 'feeder' => $feeder, 'seat_booked' => $seat_booked]);
    }

    public function update_create($id_pesanan, $id_trip){
        $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
        $detail = Detail_Pesanan::where('id_pesanan', $id_pesanan)
                    ->where('status', '!=', 5)
                    ->get();

        $jumlah = $detail->count();
        $kota = Kota::all();

        $trip = Trip::all();
        $pemesan = Pemesan::all();
        // $seat = Seat::all();

        $seat_b = Detail_Pesanan::where('id_trip', $id_trip)
                        ->where('status', '!=', 5)
                        ->count();
        $seat = 7 - $seat_b;

        return view('erte.pesanan.update_create', ['pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan, 'seat' => $seat, 'detail' => $detail, 'jumlah' => $jumlah, 'kota' => $kota]);
    }

    public function update($id_pesanan, $id_trip, Request $request){

            $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
            $pesanan->id_trip = $request->id_trip;          
            $pesanan->id_pengurus = Auth::guard('pengurus')->user()->id_pengurus;
            $pesanan->save();

            $detail = Detail_Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->get();

            if(count($request->id_seat) > 0){
                for($i = 0; $i < count($request->id_seat); $i++){
                    $detail[$i]->id_trip = $pesanan->id_trip;
                    $detail[$i]->id_seat = $request->id_seat[$i];
                    $detail[$i]->id_pesanan = $pesanan->id_pesanan;
                    $detail[$i]->nama_penumpang = $request->nama_penumpang[$i];
                    $detail[$i]->jenis_kelamin = $request->jenis_kelamin[$i];
                    $detail[$i]->detail_asal = $request->detail_asal[$i];
                    $detail[$i]->detail_tujuan = $request->detail_tujuan[$i];
                    $detail[$i]->no_hp = $request->no_hp[$i];
                    $detail[$i]->id_users_feeder = $request->id_users_feeder[$i];
                    $detail[$i]->biaya_tambahan = $request->biaya_tambahan[$i];
                    $detail[$i]->status = $request->status[$i];
                    $detail[$i]->save();
                }
            }

            session()->flash('flash_success', 'Berhasil mengupdate data pesanan');
            return redirect('/pesanan/show/'. $id_pesanan .'/' . $id_trip);
                       
    }

    public function update_search($id_pesanan, $id_trip){
            

            $id_kota_asal = Input::get('id_kota_asal');
            $id_kota_tujuan = Input::get('id_kota_tujuan');
            $tanggal = Input::get('tanggal');
            $filter = '%'.$tanggal.'%';
            $jumlah_penumpang = Input::get('jumlah_penumpang');
            $pesanan = Pesanan::where('id_pesanan', $id_pesanan)->get();
        
            $trip_a = Trip::where(['id_kota_asal' => $id_kota_asal, 
                                       'id_kota_tujuan' => $id_kota_tujuan,])
                            ->where('jadwal', 'like', $filter)
                            ->get();

                $seat_a = Detail_Pesanan::join('pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
                            ->join('trip', 'pesanan.id_trip', '=', 'trip.id_trip')
                            ->where(['trip.id_kota_asal' => $id_kota_asal, 
                                       'trip.id_kota_tujuan' => $id_kota_tujuan,])
                            ->where('jadwal', 'like', $filter)
                            ->select('detail_pesanan.id_seat')
                            ->get();
                $jumlah_seat = $seat_a->count();
                $seat = 7 - $jumlah_seat;

                    return view('erte.pesanan.update_search', ['trip_a' => $trip_a, 'id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan, 'tanggal' => $tanggal, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat, 'pesanan' => $pesanan]);
    }

     public function show($id_pesanan, $id_trip){

        $trip = Trip::find($id_trip);
        $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();   
        $detail = Detail_Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])
                    ->orderBy('id_seat', 'asc')
                    ->get();
        $seat_b = Detail_Pesanan::where('id_trip', $id_trip)
                        ->where('status', '!=', 5)
                        ->count();
        $seat_tersedia = 7 - $seat_b;

        $jumlah_penumpang = Detail_Pesanan::where('id_trip', $id_trip)
                        ->where('id_pesanan', '=', $id_pesanan)
                        ->where('status', '!=', 5)
                        ->count();
                   
        $feeder = Feeder::where('id_kota', $trip->id_kota_asal)->get();
        
        return view('erte.pesanan.show', ['trip' => $trip, 'pesanan' => $pesanan, 'detail' => $detail, 'feeder' => $feeder, 'seat_tersedia' => $seat_tersedia, 'jumlah' => $jumlah_penumpang]);

    }

    public function print($id_pesanan, $id_trip){

        $trip = Trip::find($id_trip);
        $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();   
        $detail = Detail_Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])
                    ->where('status', '!=', 5)
                    ->orderBy('id_seat', 'asc')
                    ->get();
        $jumlah_penumpang = Detail_Pesanan::where('id_trip', $id_trip)
                        ->where('id_pesanan', '=', $id_pesanan)
                        ->where('status', '!=', 5)
                        ->count();
                   
        $feeder = Feeder::where('id_kota', $trip->id_kota_asal)->get();
        
        return view('erte.pesanan.print', ['trip' => $trip, 'pesanan' => $pesanan, 'detail' => $detail, 'feeder' => $feeder, 'jumlah' => $jumlah_penumpang]);

    }

    public function update_feeder($id_pesanan, $id_trip){

        $trip = Trip::find($id_trip);
        $feeder = Input::get('id_users_feeder');
        $id_seat = Input::get('id_seat');
        // dd($feeder);
        Detail_Pesanan::where('id_seat', $id_seat)
          ->update(['id_users_feeder' => $feeder]);  

        session()->flash('flash_success', 'Berhasil mengubah data feeder');
        return redirect('/pesanan/show/'. $id_pesanan .'/' . $id_trip);
        
    }

 	public function delete($id_pesanan, $id_trip){
        $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
        $pesanan->delete();

        session()->flash('flash_success', "Berhasil menghapus pesanan");
        return redirect('/pesanan');
    	
    }
}
