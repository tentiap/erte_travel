<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
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
        if (Auth::guard('pengurus')->user()->id_pengurus == 'admin') {
        
            $pesanan = Pesanan::join('trip', ['pesanan.jadwal' => 'trip.jadwal', 'pesanan.plat_mobil' => 'trip.plat_mobil'])
                                    ->orderBy('pesanan.tanggal_pesan', 'desc')->paginate(10);
            
                                    // dd($pesanan);
            // $pesanan = DB::table('pesanan')
            //                 ->join('trip', function ($join) {
            //                     $join->on('pesanan.jadwal', '=', 'trip.jadwal');
            //                     $join->on('pesanan.plat_mobil', '=', 'trip.plat_mobil');
            //                 })
            //                 // ->orderBy('pesanan.tanggal_pesan', 'asc')
            //                 ->get();

            // dd($pesanan);

            // Post::joinRelationship('comments', function ($join) {
            //     $join->on('posts.user_id', '=', 'comments.user_id');
            // });

            // $pesanan = Pesanan::all();

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

            $pesanan = Pesanan::join('trip', ['pesanan.jadwal' => 'trip.jadwal', 'pesanan.plat_mobil' => 'trip.plat_mobil'])
                                ->where('trip.id_kota_asal', $kota)    
                                ->orderBy('pesanan.tanggal_pesan', 'desc')->paginate(10);
            // $pesanan = DB::table('pesanan')
            //                 ->join('trip', function ($join) {
            //                     $join->on('pesanan.jadwal', '=', 'trip.jadwal')->On('pesanan.plat_mobil', '=', 'trip.plat_mobil');
            //                 })
            //                 ->where('trip.id_kota_asal', $kota)
            //                 ->orderBy('pesanan.tanggal_pesan', 'desc')->paginate(10);

            // $pesanan = DB::table('pesanan')
            // ->join('trip', function ($join) {
            //     $join->on('pesanan.jadwal', '=', 'trip.jadwal');
            //     $join->on('pesanan.plat_mobil', '=', 'trip.plat_mobil');
            // })
            // // ->orderBy('pesanan.tanggal_pesan', 'asc')
            // ->get();
            

            // $pesanan = Pesanan::all();
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
            $p = Input::get('id_pemesan');
            $pemesan = Pemesan::where('id_pemesan', $p)->get();
            $today = Carbon::now();
            $filter_today = date('Y-m-d H:i:s', strtotime($today));
       
        if (Auth::guard('pengurus')->user()->id_pengurus == 'admin') {
            $trip_a = Trip::where(['id_kota_asal' => $id_kota_asal, 
                               'id_kota_tujuan' => $id_kota_tujuan,])
                    ->where('trip.jadwal', 'like', $filter)
                    ->where('trip.jadwal', '>', $filter_today)
                    ->orderBy('trip.jadwal', 'asc')
                    ->get(); 

            $seat_a = Trip::join('detail_pesanan', ['trip.jadwal' => 'detail_pesanan.jadwal', 'trip.plat_mobil' => 'detail_pesanan.plat_mobil'])
                            ->where(['id_kota_asal' => $id_kota_asal, 
                                       'id_kota_tujuan' => $id_kota_tujuan,])
                            ->where('trip.jadwal', 'like', $filter)
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
   
                $seat_a = Trip::join('detail_pesanan', ['trip.jadwal' => 'detail_pesanan.jadwal', 'trip.plat_mobil' => 'detail_pesanan.plat_mobil'])
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

    public function detail($jumlah_penumpang, $jadwal, $plat_mobil, $id_pemesan){

        if (Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil, 'id_pemesan' => $id_pemesan])->
                    exists()){
            
            session()->flash('flash_danger', 'Data pemesan di trip ini sudah ada');
            return redirect('/pesanan');

        }else{

            $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->get();
            $jumlah_penumpang = $jumlah_penumpang;
            $pemesan = Pemesan::where('id_pemesan', $id_pemesan)->get();
            $seat = Seat::all();
            $seat_b = Detail_Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
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

    public function update_detail($jadwal, $plat_mobil, $id_pemesan){

            $jumlah_penumpang = Input::get('jumlah_penumpang');
            $pesanan = Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
            $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->get();
           
            $pemesan = Pemesan::where('id_pemesan', $id_pemesan)->get();
            $seat = Seat::all();
            $seat_b = Detail_Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                        ->where('status', '!=', 5)
                        ->orderBy('id_seat', 'ASC')
                        ->get();
            $seat_tersedia = 7 - ($seat_b->count());    
        
        return view('erte.pesanan.update_detail', ['trip' => $trip, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat, 'pemesan' => $pemesan, 'seat_b' => $seat_b, 'seat_tersedia' => $seat_tersedia, 'pesanan' => $pesanan]);
    }

    public function store($jumlah_penumpang, $jadwal, $plat_mobil, $id_pemesan, Request $request){
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
                            if (Detail_Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil, 'id_seat' => $request->id_seat[$i]])->where('status', '!=', 5)->exists()) {
                                session()->flash('flash_danger', 'Seat ' .$request->id_seat[$i]. ' sudah dibooking');
                                echo redirect('/pesanan/create_detail/'.$jumlah_penumpang. '/' .$jadwal. '/' . '/' .$plat_mobil. '/' .$id_pemesan);
                            }elseif (in_array($request->id_seat[$i], $requestedSeat) == false){
                                array_push($requestedSeat, $request->id_seat[$i]);
                            }elseif (in_array($request->id_seat[$i], $requestedSeat) == true){
                                session()->flash('flash_danger', 'Seat ' .$request->id_seat[$i]. ' tidak bisa diisi lebih dari 1 orang');
                                return redirect('/pesanan/create_detail/'.$jumlah_penumpang. '/' .$id_trip. '/' .$id_users_pemesan);
                            }       
                    }
                }

                $pesanan = new Pesanan();
                    // $pesanan_select = Pesanan::select('id_pesanan');
                    // $pesanan_count = $pesanan_select->count();
                    //     if ($pesanan_count === 0) {
                    //         $pesanan->id_pesanan = 'P1';
                    //     }else{
                    //         $lastrow=$pesanan_select->orderBy('tanggal_pesan','desc')->first();
                    //         $lastrow_id = explode('P', $lastrow->id_pesanan);
                    //         $new_id = $lastrow_id[1]+1;
                    //         $pesanan->id_pesanan = 'P'.$new_id;
                    //     }
                $pesanan->id_pemesan = $id_pemesan;            
                $pesanan->jadwal = $jadwal;
                $pesanan->plat_mobil = $plat_mobil;
                $pesanan->tanggal_pesan = date('Y-m-d H:i:s');
                $pesanan->id_pengurus = Auth::guard('pengurus')->user()->id_pengurus;
                $pesanan->save();

                foreach($request->id_seat as $key => $value){
                    Detail_Pesanan::create([
                        'jadwal' => $pesanan->jadwal,
                        'plat_mobil' => $pesanan->plat_mobil,
                        'id_seat' => $request->id_seat[$key],
                        'order_number' => 1,
                        'id_pemesan' => $pesanan->id_pemesan,
                        'nama_penumpang' => $request->nama_penumpang[$key],
                        'jenis_kelamin' => $request->jenis_kelamin[$key],
                        'detail_asal' => $request->detail_asal[$key],
                        'detail_tujuan' => $request->detail_tujuan[$key],
                        'no_hp' => $request->no_hp[$key],
                        'biaya_tambahan' => 0,
                        'status' => 1
                    ]);
                }

                // foreach($request->id_seat as $key => $value){
                //     $detail = new Detail_Pesanan();
                //     $detail->jadwal = $pesanan->jadwal;
                //     $detail->plat_mobil = $pesanan->plat_mobil;
                //     $detail->id_seat = $request->id_seat[$key];

                //     $cancelled = Detail_Pesanan::where(['jadwal' => $pesanan->jadwal, 'plat_mobil' => $pesanan->plat_mobil, 'id_seat' => $request->id_seat[$key]])->where('status', '=', 5)->get();

                //     if ($cancelled->exists()) {
                //         $order_number_select =  
                //     }
                //     $detail->order_number = $pesanan->jadwal;

                //     $detail->jadwal = $pesanan->jadwal;
                //     $detail->jadwal = $pesanan->jadwal;
                //     $detail->jadwal = $pesanan->jadwal;
                //     $detail->jadwal = $pesanan->jadwal;
                //     $detail->jadwal = $pesanan->jadwal;
                //     $detail->jadwal = $pesanan->jadwal;
                //     $detail->jadwal = $pesanan->jadwal;
                //     $detail->jadwal = $pesanan->jadwal;
                //     $detail->save();
                // }

                session()->flash('flash_success', 'Berhasil menambahkan data pesanan ');
                return redirect('/pesanan');    

    }

    public function update_store($jumlah_penumpang, $id_pemesan, $jadwal, $plat_mobil, Request $request){
        $this->validate($request, 
            [
            // 'id_users' => 'required',
            'nama_penumpang' => 'required',
            'jenis_kelamin' => 'required',
            'id_seat' => 'required',
            'detail_asal' => 'required',
            'detail_tujuan' => 'required'            
        ]);

        $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->get();

        if(Detail_Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil, 'id_seat' => $request->id_seat])
                ->where('status', '!=', 5)
                ->exists()) {
                        
                    session()->flash('flash_danger', 'Seat sudah dibooking');
                    return redirect('/pesanan/edit');
        }else{
            foreach($request->nama_penumpang as $key => $value){
                    Detail_Pesanan::create([
                        'jadwal' => $jadwal,
                        'plat_mobil' => $plat_mobil,
                        'id_seat' => $request->id_seat[$key],
                        'id_pemesan' => $id_pemesan,
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
                return redirect('/pesanan/show/' .$id_pemesan. '/' .$jadwal. '/' .$plat_mobil );

        }             

                
    }

    public function edit($id_pemesan, $jadwal, $plat_mobil){
    	$pesanan = Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();

        $detail = Detail_Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->orderBy('id_seat', 'ASC')->get();
        $jumlah = $detail->count();
        $kota = Kota::all();

    	// $trip = Trip::find($jadwal, $plat_mobil);
        $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();

        $string_jadwal = preg_replace('/[^0-9]/', '', date('Y m d', strtotime($trip->jadwal)));
        $id = $id_pemesan.$string_jadwal.$plat_mobil;
        // $id_trip = $string_jadwal.$plat_mobil;

        // dd($trip);

    	$pemesan = Pemesan::all();
        $seat = Seat::all();
        $feeder = Feeder::where('id_kota', $trip->id_kota_asal)->get();

        $seat_b = Detail_Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                        ->where('status', '!=', 5)
                        // ->select('id_seat')
                        ->orderBy('id_seat', 'ASC')
                        ->get();

         json_decode($seat_b, true);
                $seat_booked = array();
    
                for ($i=0; $i < $seat_b->count() ; $i++) { 
                    array_push($seat_booked, $seat_b[$i]['id_seat']);
                }

        return view('erte.pesanan.edit', ['pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan, 'seat' => $seat, 'detail' => $detail, 'jumlah' => $jumlah, 'kota' => $kota, 'seat_b' => $seat_b, 'feeder' => $feeder, 'seat_booked' => $seat_booked, 'id' => $id]);
    }

    public function update_create($id_pemesan, $jadwal, $plat_mobil){
        // $pesanan = Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();

        $pesanan = Pesanan::join('trip', ['pesanan.jadwal' => 'trip.jadwal', 'pesanan.plat_mobil' => 'trip.plat_mobil'])->where('pesanan.id_pemesan', $id_pemesan)->first();

        // dd($pesanan);

        $detail = Detail_Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                    ->where('detail_pesanan.status', '!=', 5)
                    ->get();
        
        $string_jadwal = preg_replace('/[^0-9]/', '', date('Y m d', strtotime($jadwal)));
        $id = $id_pemesan.$string_jadwal.$plat_mobil;

        

        $jumlah = $detail->count();
        $kota = Kota::all();

        $trip = Trip::all();
        $pemesan = Pemesan::all();
        // $seat = Seat::all();

        $seat_b = Detail_Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                        ->where('detail_pesanan.status', '!=', 5)
                        ->count();
        $seat = 7 - $seat_b;

        return view('erte.pesanan.update_create', ['pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan, 'seat' => $seat, 'detail' => $detail, 'jumlah' => $jumlah, 'kota' => $kota, 'id' => $id]);
    }

    public function update($id_pemesan, $jadwal, $plat_mobil, Request $request){

            $pesanan = Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
            $pesanan->jadwal = $request->jadwal;
            $pesanan->plat_mobil = $request->plat_mobil;                    
            $pesanan->id_pengurus = Auth::guard('pengurus')->user()->id_pengurus;
            $pesanan->save();

            $detail = Detail_Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->get();

            if(count($request->id_seat) > 0){
                for($i = 0; $i < count($request->id_seat); $i++){
                    $detail[$i]->jadwal = $pesanan->jadwal;
                    $detail[$i]->plat_mobil = $pesanan->plat_mobil;
                    $detail[$i]->id_seat = $request->id_seat[$i];
                    $detail[$i]->id_pemesan = $pesanan->id_pemesan;
                    $detail[$i]->nama_penumpang = $request->nama_penumpang[$i];
                    $detail[$i]->jenis_kelamin = $request->jenis_kelamin[$i];
                    $detail[$i]->detail_asal = $request->detail_asal[$i];
                    $detail[$i]->detail_tujuan = $request->detail_tujuan[$i];
                    $detail[$i]->no_hp = $request->no_hp[$i];
                    $detail[$i]->id_feeder = $request->id_feeder[$i];
                    $detail[$i]->biaya_tambahan = $request->biaya_tambahan[$i];
                    $detail[$i]->status = $request->status[$i];
                    $detail[$i]->save();
                }
            }

            session()->flash('flash_success', 'Berhasil mengupdate data pesanan');
            return redirect('/pesanan/show/'. $id_pemesan .'/' . $jadwal. '/' . $plat_mobil );
                       
    }

    public function update_search($id_pemesan, $jadwal, $plat_mobil){
            

            $id_kota_asal = Input::get('id_kota_asal');
            $id_kota_tujuan = Input::get('id_kota_tujuan');
            $tanggal = Input::get('tanggal');
            $filter = '%'.$tanggal.'%';
            $jumlah_penumpang = Input::get('jumlah_penumpang');
            $pesanan = Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->get();
        
            $trip_a = Trip::where(['id_kota_asal' => $id_kota_asal, 
                                       'id_kota_tujuan' => $id_kota_tujuan,])
                            ->where('jadwal', 'like', $filter)
                            ->get();

                $seat_a = Detail_Pesanan::join('pesanan', ['pesanan.id_pemesan' => $detail_pesanan.id_pemesan, 'pesanan.jadwal' => 'detail_pesanan.jadwal', 'pesanan.plat_mobil' => 'detail_pesanan.plat_mobil'])
                            ->join('trip', ['pesanan.jadwal' => 'trip.jadwal', 'pesanan.plat_mobil' => 'trip.plat_mobil'])
                            ->where(['trip.id_kota_asal' => $id_kota_asal, 
                                       'trip.id_kota_tujuan' => $id_kota_tujuan,])
                            ->where('jadwal', 'like', $filter)
                            ->select('detail_pesanan.id_seat')
                            ->get();
                $jumlah_seat = $seat_a->count();
                $seat = 7 - $jumlah_seat;

                    return view('erte.pesanan.update_search', ['trip_a' => $trip_a, 'id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan, 'tanggal' => $tanggal, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat, 'pesanan' => $pesanan]);
    }

     public function show($id_pemesan, $jadwal, $plat_mobil){

        // $trip = Trip::find([$jadwal, $plat_mobil]);
        $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
        $pesanan = Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();   
        $detail = Detail_Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                    ->orderBy('id_seat', 'asc')
                    ->get();

        $string_jadwal = preg_replace('/[^0-9]/', '', date('Y m d', strtotime($trip->jadwal)));
                // dd($string_jadwal);

        $id = $id_pemesan.$string_jadwal.$plat_mobil;
        $id_trip = $string_jadwal.$plat_mobil;
        
        if($detail->isEmpty()) {
            session()->flash('flash_danger', 'Belum ada detail pesanan');
            return redirect('/pesanan');
        }

        $seat_b = Detail_Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                        ->where('status', '!=', 5)
                        ->count();
        $seat_tersedia = 7 - $seat_b;

        $jumlah_penumpang = Detail_Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                        ->where('status', '!=', 5)
                        ->count();
                   
        $feeder = Feeder::where('id_kota', $trip->id_kota_asal)->get();
        
        return view('erte.pesanan.show', ['trip' => $trip, 'pesanan' => $pesanan, 'detail' => $detail, 'feeder' => $feeder, 'seat_tersedia' => $seat_tersedia, 'jumlah' => $jumlah_penumpang, 'id' => $id, 'id_trip' => $id_trip ]);

    }

    public function print($id_pemesan, $jadwal, $plat_mobil){

        // $trip = Trip::find($jadwal, $plat_mobil);
        $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();

        $pesanan = Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();   
        $detail = Detail_Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])
                    ->where('status', '!=', 5)
                    ->orderBy('id_seat', 'asc')
                    ->get();
                    
        $jumlah_penumpang = Detail_Pesanan::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil, 'id_pemesan' => $id_pemesan])
                        ->where('status', '!=', 5)
                        ->count();
                   
        $feeder = Feeder::where('id_kota', $trip->id_kota_asal)->get();
        
        return view('erte.pesanan.print', ['trip' => $trip, 'pesanan' => $pesanan, 'detail' => $detail, 'feeder' => $feeder, 'jumlah' => $jumlah_penumpang]);

    }

    public function update_feeder($id_pemesan, $jadwal, $plat_mobil){

        // $trip = Trip::find($jadwal, $plat_mobil);
        $trip = Trip::where(['jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
        $feeder = Input::get('id_feeder');
        $id_seat = Input::get('id_seat');
        // dd($feeder);
        Detail_Pesanan::where('id_seat', $id_seat)
          ->update(['id_feeder' => $id_feeder]);  

        session()->flash('flash_success', 'Berhasil mengubah data feeder');
        return redirect('/pesanan/show/' .$id_pemesan. '/' .$jadwal. '/' .$plat_mobil);
        
    }

 	public function delete($id_pemesan, $jadwal, $plat_mobil){
        $pesanan = Pesanan::where(['id_pemesan' => $id_pemesan, 'jadwal' => $jadwal, 'plat_mobil' => $plat_mobil])->first();
        $pesanan->delete();

        session()->flash('flash_success', "Berhasil menghapus pesanan");
        return redirect('/pesanan');
    	
    }
}
