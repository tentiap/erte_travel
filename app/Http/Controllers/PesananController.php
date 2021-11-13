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
use App\Operator;
use App\Detail_Pesanan;
use App\Kota;
use App\Seat;
use DateTime;
use Carbon\Carbon;

class PesananController extends Controller
{
    public function index(){
        if (Auth::guard('operator')->user()->id_users == 'admin') {
        
            $pesanan = Pesanan::join('trip', 'pesanan.id_trip', '=', 'trip.id_trip')
                                    ->orderBy('pesanan.created_at', 'desc')->paginate(10);

            $trip = Trip::all();
            $pemesan = Pemesan::all();
            $operator = Operator::all();


            return view('erte.pesanan.index', ['pesanan' => $pesanan, 'trip' => $trip,  'pemesan' => $pemesan, 'operator' => $operator]);
        }else{

            $kota = Auth::guard('operator')->user()->id_kota;
            $pesanan = Pesanan::join('trip', 'pesanan.id_trip', '=', 'trip.id_trip')
                        ->where('trip.id_kota_asal',  $kota)
                        ->orderBy('trip.jadwal', 'desc')->paginate(10);
                        // ->get();
            $trip = Trip::all();
            $pemesan = Pemesan::all();
            $operator = Operator::all();

            return view('erte.pesanan.index', ['pesanan' => $pesanan, 'trip' => $trip,  'pemesan' => $pemesan, 'operator' => $operator]);
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
            // dd($filter_today);
            // dd($pemesan);
            // return response()->json($pemesan);

        // $trip_a = Trip::join('detail_pesanan', 'trip.id_trip', 'detail_pesanan.id_trip')
        //             ->where(['trip.id_kota_asal' => $id_kota_asal,
        //                      'trip.id_kota_tujuan' => $id_kota_tujuan])
        //             ->where('jadwal', 'like', $filter)
        //             ->select('trip.id_trip as id_trip',
        //                      'trip.jadwal as jadwal',
        //                      'detail_pesanan.id_seat as id_seat')
        //             ->get();
        //             dd($trip_a);

        if (Auth::guard('operator')->user()->id_users == 'admin') {
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
            if (Auth::guard('operator')->user()->id_kota != $id_kota_asal) {
                session()->flash('flash_danger', 'Pesanan berada di luar wilayah operasional operator');
                return redirect('/pesanan/create');
            }else{
            
                $trip_a = Trip::where(['id_kota_asal' => $id_kota_asal, 
                               'id_kota_tujuan' => $id_kota_tujuan,])
                    ->where('jadwal', 'like', $filter)
                    ->where('jadwal', '>', $filter_today)
                    ->get(); 
                    // ->where('date', '<=', '2014-07-10 23:59:59')

                    // dd($trip_a);

                // $seat_a = Detail_Pesanan::join('pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
                //             ->join('trip', 'pesanan.id_trip', '=', 'trip.id_trip')
                //             ->where(['trip.id_kota_asal' => $id_kota_asal, 
                //                        'trip.id_kota_tujuan' => $id_kota_tujuan,])
                //             ->where('jadwal', 'like', $filter)
                //             ->select('detail_pesanan.id_seat')
                //             ->count();

                $seat_a = Trip::join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
                            ->where(['id_kota_asal' => $id_kota_asal, 
                                       'id_kota_tujuan' => $id_kota_tujuan,])
                            ->where('jadwal', 'like', $filter)
                            ->where('jadwal', '>', $filter_today)
                            ->where('detail_pesanan.status', '!=', 5)
                            ->select('detail_pesanan.id_seat')
                            ->count();

                            // dd($seat_a);
                            
                // // $jumlah_seat = $seat_a->count();
                //             dd($seat_a);
                $seat = ($trip_a->count() * 7) - $seat_a;
                      
                if(!$trip_a->isEmpty() && $seat >= $jumlah_penumpang){
                    // return response()->json($trip_a);

                    return view('erte.pesanan.search', ['trip_a' => $trip_a, 'id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan, 'tanggal' => $tanggal, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat, 'pemesan' => $pemesan, 'seat_a' => $seat_a]);
                    // dd($trip_a->jumlah_penumpang);
                }else{
                    session()->flash('flash_danger', 'Tidak ada trip');
                    return redirect('/pesanan/create');
                }   
        }

    }
        
        
    }

    // public function search(Request $request){
    //     $this->validate($request, [
    //         'id_kota_asal' => 'required',    
    //         'id_kota_tujuan' => 'required',
    //         'tanggal' => 'required',
    //         'jumlah_penumpang' => 'required',
    //     ]);

    //         $id_kota_asal = Input::get('id_kota_asal');
    //         $id_kota_tujuan = Input::get('id_kota_tujuan');
    //         $tanggal = Input::get('tanggal');
    //         $filter = '%'.$tanggal.'%';
    //         $jumlah_penumpang = Input::get('jumlah_penumpang');

    //     $trip_a = Trip::where(['id_kota_asal' => $id_kota_asal, 
    //                            'id_kota_tujuan' => $id_kota_tujuan,])
    //                 ->where('jadwal', 'like', $filter)
    //                 ->get();

    //     if(!$trip_a->isEmpty()){
    //         // return response()->json($trip_a);
    //         return view('erte.pesanan.search', ['trip_a' => $trip_a, 'id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan, 'tanggal' => $tanggal, 'jumlah_penumpang' => $jumlah_penumpang]);
    //     }else{
    //         session()->flash('flash_danger', 'Tidak ada trip');
    //         return redirect('/pesanan/create');
    //     }  

        
    // }

    public function getTrip(){
        $id_kota_a = Input::get('id_kota_asal');
        $id_kota_t = Input::get('id_kota_tujuan');
        // $date = new DateTime();
        // $date->format('YYYY-MM-DD HH:mm');
        // $date = Carbon::now();
        // dd($date);
        // $date = Carbon::today();
        // $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'Europe/Stockholm');
        // $id_kota_a = 'K2';
        // $id_kota_t = 'K1';
        // echo $date->format('Y-m-d H:i:s');
        // $trip_a = Trip::where(['id_kota_asal' => $id_kota_a, 'id_kota_tujuan' => $id_kota_t])
        //             ->whereDate('jadwal', '>', Carbon::now())
        //             ->get();                  

        $tes = Trip::select('jadwal')
                ->where(['id_kota_asal' => $id_kota_a, 'id_kota_tujuan' => $id_kota_t])
                ->whereDate('jadwal', '>', Carbon::now())
                ->get();

        // $jadwal = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $trip_a->jadwal)->format('d-m-Y');
        
        // $data = DB::table('tablename')->where('condition',$condition)->first();
        // $newtime = strtotime($tes);
        // $tes->time = date('d M Y',$newtime);

        // foreach($tes as $d){
        //     $newtime = strtotime($d);
        //     $d->time = date('M d, Y',$newtime);
        // }

        // $date = date('Y-m-d H:i:s');

        // $newDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tes)->format('d-m-Y');

        // dd($newDate);        

        // dd($tes->time);
       

        // 'jadwal' => date('Y-m-d', strtotime($tes));

        // $d = Carbon::createFromFormat('Y-m-d H:i:s', $d)->format('d/m/Y');            
        // dd($d); 

        
        // $tes = Carbon::parse($jadwal)->format('d/m/Y');
        // dd($tes);

        // $tes = $jadwal('d-m-Y H:i:s', strtotime($jadwal));        
       
        // $tanggal = Trip::with(array('posts' => function($query){
        //     $query->where('title', 'like', '%first%');
        // }))->get();

        // $rute = Rute::with("kota_tujuan")->whereHas("kota_asal",function($query) use($id_kota_a){
        //     $query->where("id_kota","=",$id_kota_a);
        // })->get();

        // return Carbon::parse($jadwal)->format('d/m/Y');  
        // return Carbon::createFromFormat('d/m/Y', $request->jadwal);      
        return response()->json($tes);
        // return date('d-M-Y', strtotime($trip_a));

        //  $id_kota_tujuan = Rute::where('id_kota_asal', $id_kota_asal)->get();
        // return response()->json($id_kota_tujuan);
        // return Rute::get()->load('kota_tujuan');
        
    }

    public function detail($jumlah_penumpang, $id_trip, $id_users_pemesan){

        if (Pesanan::where(['id_trip' => $id_trip, 'id_users_pemesan' => $id_users_pemesan])->
                    exists()){
            // $id_pesanan = Pesanan::where(['id_trip' => $id_trip, 'id_users_pemesan' => $id_users_pemesan])->select('id_pesanan')->get();
            
            session()->flash('flash_danger', 'Data pemesan di trip ini sudah ada');
            // return redirect('/pesanan/show/'. $id_pesanan .'/' . $id_trip);
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
             
        // dd($pemesan);
        // return response()->json($pemesan);

        // $tes = Trip::select('jadwal')
        //         ->where(['id_kota_asal' => $id_kota_a, 'id_kota_tujuan' => $id_kota_t])
        //         ->whereDate('jadwal', '>', Carbon::now())
        //         ->get();
        

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

        // $trip = Trip::where(['id_trip' => $id_trip])->get();
        // // $trip = Trip::find($id_trip);
        // $pemesan = Pemesan::where('id_users', $id_users_pemesan)->get();
        // $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
        // // $detail = Detail_Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])
        // //             ->orderBy('id_seat', 'ASC')->get();
        // $seat = Seat::all();

        // //
        
       
        // $kota = Kota::all();
        // $feeder = Feeder::where('id_kota', $trip->id_kota_asal)->get();

        // $detail = Detail_Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])
        //                 ->where('status', '!=', 5)
        //                 ->orderBy('id_seat', 'ASC')
        //                 ->get();
                        
        //  $jumlah = $detail->count();                
        
        return view('erte.pesanan.update_detail', ['trip' => $trip, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat, 'pemesan' => $pemesan, 'seat_b' => $seat_b, 'seat_tersedia' => $seat_tersedia, 'pesanan' => $pesanan]);
    }

	// public function store($jumlah_penumpang, $id_trip, $id_users_pemesan, Request $request){
 //        $this->validate($request, 
 //            [
 //            // 'id_users' => 'required',
 //            'nama_penumpang' => 'required',
 //            'jenis_kelamin' => 'required',
 //            'id_seat' => 'required',
 //            'detail_asal' => 'required',
 //            'detail_tujuan' => 'required'            
 //        ]);
 //        // $trip = Trip::where(['id_trip' => $id_trip])->get();

 //        // $seat = Input::get('id_seat');
 //        // $booked = Detail_Pesanan::where(['id_trip' => $id_trip])
 //        //                             ->where('status', '=', 5)
 //        //                             ->get();

 //        // dd($booked);

 //        // if (Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $request->id_seat])
 //        //                   ->where('status', '=', 5){
 //        //     // echo "String";
 //        //     return "String";
 //        // }else{
 //        //     return "Else";
 //        // }

 //        //Cek lagi disini, ini untuk pesan seat di suatu trip yang statusnya udah cancel
 //        // if(Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $request->id_seat])
 //        //         ->where('status', '=', 5)
 //        //         ->exists()) {
 //        //             session()->flash('flash_danger', 'Statusnya 5, bisa pesan');
 //        //             return redirect('/pesanan/create_detail/'.$jumlah_penumpang. '/' .$id_trip. '/' .$id_users_pemesan);
 //        // }else{
 //        //     session()->flash('flash_danger', 'Status tidak 5');
 //        //     return redirect('/pesanan/create_detail/'.$jumlah_penumpang. '/' .$id_trip. '/' .$id_users_pemesan);
 //        // }
              
 //            //Ambil kodingan lama di github, untuk testing, nanti hapus lagi
 //            if(Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $request->id_seat])
 //                ->where('status', '!=', 5)
 //                ->exists()) {
 //                        // dd("Seat sudah ada, tapi status nya ndak cancel. Berarti ndak  bisa pesan seat ni lagi, karena dah booking");
 //                    session()->flash('flash_danger', 'Seat sudah dibooking');
 //                    return redirect('/pesanan/create_detail/'.$jumlah_penumpang. '/' .$id_trip. '/' .$id_users_pemesan);

 //            }else{
 //                // dd("Seat belum ada, bisa pesan. Atau seat sebelumnya sudah dicancel");
 //                    $pesanan = new Pesanan();
 //                    $pesanan_select = Pesanan::select('id_pesanan');
 //                    $pesanan_count = $pesanan_select->count();
 //                        if ($pesanan_count === 0) {
 //                            $pesanan->id_pesanan = 'P1';
 //                        }else{
 //                            $lastrow=$pesanan_select->orderBy('created_at','desc')->first();
 //                            $lastrow_id = explode('P', $lastrow->id_pesanan);
 //                            $new_id = $lastrow_id[1]+1;
 //                            $pesanan->id_pesanan = 'P'.$new_id;
 //                        }
 //                $pesanan->id_trip = $id_trip;
 //                $pesanan->id_users_pemesan = $id_users_pemesan;            
 //                $pesanan->tanggal_pesan = date('Y-m-d H:i:s');
 //                $pesanan->id_users_operator = Auth::guard('operator')->user()->id_users;
 //                $pesanan->save();

 //                if(Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $request->id_seat])
 //                        ->where('status', '!=', 5)
 //                        ->exists()) {
 //                    session()->flash('flash_danger', 'Seat sudah dibooking');
 //                    return redirect('/pesanan/create_detail/'.$jumlah_penumpang. '/' .$id_trip. '/' .$id_users_pemesan);

 //                }else{
 //                    foreach($request->nama_penumpang as $key => $value){
 //                            Detail_Pesanan::create([
 //                                'id_trip' => $pesanan->id_trip,
 //                                'id_seat' => $request->id_seat[$key],
 //                                'id_pesanan' => $pesanan->id_pesanan,
 //                                'nama_penumpang' => $request->nama_penumpang[$key],
 //                                'jenis_kelamin' => $request->jenis_kelamin[$key],
 //                                'detail_asal' => $request->detail_asal[$key],
 //                                'detail_tujuan' => $request->detail_tujuan[$key],
 //                                'no_hp' => $request->no_hp[$key],
 //                                'biaya_tambahan' => 0,
 //                                'status' => 1
 //                            ]);
 //                        }

 //                    // Detail_Pesanan::insert($pesanan);
 //                    session()->flash('flash_success', 'Berhasil menambahkan data pesanan ');
 //                    return redirect('/pesanan');
 //                }
 //    }

    public function store($jumlah_penumpang, $id_trip, $id_users_pemesan, Request $request){
        $this->validate($request, 
            [
            // 'id_users' => 'required',
            'nama_penumpang' => 'required',
            'jenis_kelamin' => 'required',
            'id_seat' => 'required',
            'detail_asal' => 'required',
            'detail_tujuan' => 'required'            
        ]);

                //check if the requested seats have been booked before and the status is not cancelled. If yes, can't book the seat(s)
                if (count($request->id_seat) > 0) {
                    //cek dulu udah ada yang mesan seat 3 belom?
                    //Kalau udah ada, cek statusnya
                    //kalau statusnya 5, berarti bisa pesan.
                    //klau ndak, berarti ga bisa pesan
                    $requestedSeat = array();
                    for ($i=0; $i < count($request->id_seat); $i++) { 
                        // $i = 0;
                        // while ($i < count($request->id_seat)) {
                            if (Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $request->id_seat[$i]])->where('status', '!=', 5)->exists()) {
                                session()->flash('flash_danger', 'Seat ' .$request->id_seat[$i]. ' sudah dibooking');
                                echo redirect('/pesanan/create_detail/'.$jumlah_penumpang. '/' .$id_trip. '/' .$id_users_pemesan);
                                // echo ("ndak bisa pasan seat ". $request->id_seat[$i]);
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
                            $lastrow=$pesanan_select->orderBy('created_at','desc')->first();
                            $lastrow_id = explode('P', $lastrow->id_pesanan);
                            $new_id = $lastrow_id[1]+1;
                            $pesanan->id_pesanan = 'P'.$new_id;
                        }
                $pesanan->id_trip = $id_trip;
                $pesanan->id_users_pemesan = $id_users_pemesan;            
                $pesanan->tanggal_pesan = date('Y-m-d H:i:s');
                $pesanan->id_users_operator = Auth::guard('operator')->user()->id_users;
                $pesanan->save();

                
                // for ($i=0; $i < count($request->id_seat); $i++) {
                //     //to avoid duplicate data input
                //     if (in_array($request->id_seat[$i], $requestedSeat) == false) {
                //         $detail = new Detail_Pesanan();
                //         $detail[$i]->id_trip = $id_trip;
                //         $detail[$i]->id_seat = $request->id_seat[$i];
                //             array_push($requestedSeat, $request->id_seat[$i]);
                //         $detail[$i]->id_pesanan = $pesanan->id_pesanan;
                //         $detail[$i]->nama_penumpang = $request->nama_penumpang[$i];
                //         $detail[$i]->jenis_kelamin = $request->jenis_kelamin[$i];
                //         $detail[$i]->detail_asal = $request->detail_asal[$i];
                //         $detail[$i]->detail_tujuan = $request->detail_tujuan;
                //         $detail[$i]->no_hp = $request->no_hp[$i];
                //         $detail[$i]->biaya_tambahan = 0;
                //         $detail[$i]->status = 1;
                //         $detail[$i]->save();
                //     }
                //     //Disini nanti tambahkan kondisi untuk alert data input nya sama
                // }

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


                    

                    
                   

                        // if (Detail_Pesanan::where) {
                        //     json_decode($seat_b, true);
                        //     $seat_booked = array();
                

                // Detail_Pesanan::insert($pesanan);
                // session()->flash('flash_success', 'Berhasil menambahkan data pesanan ');
                // return redirect('/pesanan');

            // }
    


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

        // dd($jumlah_penumpang, $id_pesanan, $id_trip, $id_users_pemesan);
        $trip = Trip::where(['id_trip' => $id_trip])->get();

        // $seat = Input::get('id_seat');
        //     if(Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $seat])
        //         ->where('status', '!=', 5)
        //         ->exists()) {
        //                 // dd("Seat sudah ada, tapi status nya ndak cancel. Berarti ndak  bisa pesan seat ni lagi, karena dah booking");
        //             session()->flash('flash_danger', 'Seat sudah dibooking');
        //             return redirect('/pesanan/create_detail/'.$jumlah_penumpang. '/' .$id_trip. '/' .$id_users_pemesan);

        //     }else{
                // dd("Seat belum ada, bisa pesan. Atau seat sebelumnya sudah dicancel");
                //
        if(Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $request->id_seat])
                ->where('status', '!=', 5)
                ->exists()) {
                        // dd("Seat sudah ada, tapi status nya ndak cancel. Berarti ndak  bisa pesan seat ni lagi, karena dah booking");
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

                // Detail_Pesanan::insert($pesanan);
                session()->flash('flash_success', 'Berhasil menambahkan data penumpang' );
                return redirect('/pesanan/show/' .$id_pesanan. '/' .$id_trip);

            // }
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

        // for (int i = 0; i < bookedSeatData.size(); i++){
        //                 listBookedSeat.add(bookedSeatData.get(i).getIdSeat());
        //             }

        //             String[] array = listBookedSeat.toArray(new String[0]);

        //             for (int i = 1; i < 8; i++){
        //                 boolean checkBookedSeat = Arrays.asList(array).contains(String.valueOf(i));

        //                 if (checkBookedSeat == true) {
        //                     System.out.println("Skip aja ya, seat udah dibooking");
        //                 } else {
        //                     listSpinner.add(String.valueOf(i));
        //                 }
        //             }
//                
        // json_decode($seat_b, true);
        // for ($i=0; $i < $seat_b->count() ; $i++) { 
        //     $seat_available = array();
        //     array_push($seat_available, $seat_b[$i]['id_seat']);
        // }

         json_decode($seat_b, true);
                $seat_booked = array();
                

                for ($i=0; $i < $seat_b->count() ; $i++) { 
                    array_push($seat_booked, $seat_b[$i]['id_seat']);
                }

                    // echo $seat_b[$i]['id_seat'];   
       


                    

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
            $pesanan->id_users_operator = Auth::guard('operator')->user()->id_users;
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
            // dd($id_kota_asal, $id_kota_tujuan, $tanggal, $filter);
            // dd($jumlah_penumpang);
            $pesanan = Pesanan::where('id_pesanan', $id_pesanan)->get();
            // dd($pesanan);
        
            // dd($id_kota_asal, $id_kota_tujuan, $tanggal, $jumlah_penumpang, $id_pesanan);
            // return response()->json($pemesan);            

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

                // $trip_b = Trip::where(['id_kota_asal' => $id_kota_asal, 
                //                        'id_kota_tujuan' => $id_kota_tujuan,])
                //             ->where('jadwal', 'like', $filter)
                //             ->select('id_trip')
                //             ->get();

                // $id_trip = $trip_a->id_trip;
                // dd($trip_b);

                       

                // if(!$trip_a->isEmpty() && $seat > $jumlah_penumpang){
                //     // return response()->json($trip_a);
                    return view('erte.pesanan.update_search', ['trip_a' => $trip_a, 'id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan, 'tanggal' => $tanggal, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat, 'pesanan' => $pesanan]);
                //     // dd($trip_a->jumlah_penumpang);
                // }else{
                //     session()->flash('flash_danger', 'Tidak ada trip');
                //     return redirect('/pesanan/update_create/'.$id_pesanan);
                // }  
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

        // $detail = Pesanan::join('detail_pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
        //             ->join('feeder', 'feeder.id_users', 'detail_pesanan.id_users_feeder')
        //             ->where('pesanan.id_pesanan', $id_pesanan)
        //             ->select('pesanan.id_trip as pesanan_trip',
        //                      'pesanan.id_pesanan as pesanan_id',
        //                      'pesanan.id_users_pemesan as pesanan_pemesan',
        //                      'pesanan.tanggal_pesan as pesanan_tanggal',
        //                      'detail_pesanan.id_seat as detail_seat',
        //                      'detail_pesanan.nama_penumpang as detail_nama',
        //                      'detail_pesanan.jenis_kelamin as detail_jk',
        //                      'detail_pesanan.detail_asal as detail_asal',
        //                      'detail_pesanan.detail_tujuan as detail_tujuan',
        //                      'detail_pesanan.no_hp as detail_hp',
        //                      'detail_pesanan.status as detail_status',
        //                      'detail_pesanan.biaya_tambahan as detail_biaya',
        //                      'feeder.nama as feeder')
        //             ->orderBy('detail_pesanan.id_seat', 'ASC')
        //             ->get();

        // $detail = Detail_Pesanan::join('feeder', 'detail_pesanan.id')

                   
        $feeder = Feeder::where('id_kota', $trip->id_kota_asal)->get();
       // return response()->json($feeder);
        
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



    // public function getFeeder(){
    //     $id_kota_a = Input::get('id_kota_asal');

    //     $feeder = Feeder::where('id_kota', $id_kota_a)->get();

    //     // $query->where('userid','=' ,$id_kota_asal);
    //     // dd($id_kota_asal, response()->json($rute));
    //     // dd($id_kota_a);
    //     // dd( response()->json($rute));
    //     return response()->json($feeder);

    //     //  $id_kota_tujuan = Rute::where('id_kota_asal', $id_kota_asal)->get();
    //     // return response()->json($id_kota_tujuan);
    //     // return Rute::get()->load('kota_tujuan');
        
    // }

    public function update_feeder($id_pesanan, $id_trip){

        $trip = Trip::find($id_trip);
        $feeder = Input::get('id_users_feeder');
        $id_seat = Input::get('id_seat');
        // dd($feeder);
        Detail_Pesanan::where('id_seat', $id_seat)
          ->update(['id_users_feeder' => $feeder]);  

        session()->flash('flash_success', 'Berhasil mengubah data feeder');
        // return redirect('/pesanan');
        // return redirect('/pesanan/show/{id_pesanan}/{id_trip}');
        return redirect('/pesanan/show/'. $id_pesanan .'/' . $id_trip);
        
    }

    // public function update_biaya($id_pesanan, $id_seat, Request $request){

    //     $seat = Input::get('id_seat');
    //     // $detail = Detail_Pesanan::where(['id_pesanan' => $id_pesanan, 'id_seat' => $id_seat])->first();
    //     // dd($id_seat);
    //     dd($seat);
    //     // // $feeder->id_kota = $request->id_kota;
    //     // $feeder->save();

    //     // $trip = Trip::find($id_trip);
    //     // $feeder = Input::get('id_users_feeder');
    //     // // dd($feeder);
    //     // Detail_Pesanan::where('id_pesanan', $id_pesanan)
    //     //   ->update(['id_users_feeder' => $feeder]);  

    //     // session()->flash('flash_success', 'Berhasil mengubah data feeder');
    //     // // return redirect('/pesanan');
    //     // // return redirect('/pesanan/show/{id_pesanan}/{id_trip}');
    //     // return redirect('/pesanan/show/'. $id_pesanan .'/' . $id_trip);
        
    // }

 	public function delete($id_pesanan, $id_trip){
        $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
        $pesanan->delete();

        session()->flash('flash_success', "Berhasil menghapus pesanan");
        return redirect('/pesanan');
    	
    }


}
