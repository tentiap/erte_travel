<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use App\Trip;
use App\Pesanan;
use App\Pemesan;
use App\Sopir;
use App\Feeder;
use App\Detail_Pesanan;
use App\Seat;

use DB;
use Carbon\Carbon;

class ApiController extends Controller
{   
    public function loginPemesan(Request $request){
        $pemesan = Pemesan::where('email', $request->email)->first();

        if($pemesan){
            if(password_verify($request->password, $pemesan->password)){
                return response()->json([
                    'status' => true,
                    'message' => "Welcome ".$pemesan->nama,
                    'data' => $pemesan
                ]);
            }
            return $this->error('Password salah');
        }
        return $this->error('Email tidak terdaftar');
    }

    public function loginSopir(Request $request){
        $sopir = Sopir::where('email', $request->email)->first();

        if($sopir){
            if(password_verify($request->password, $sopir->password)){
                return response()->json([
                    'status' => true,
                    'message' => "Welcome ".$sopir->nama,
                    'data' => $sopir
                ]);
            }
            return $this->error('Password salah');
        }
        return $this->error('Email tidak terdaftar');
    }

    public function loginFeeder(Request $request){
        $feeder = Feeder::where('email', $request->email)->first();

        if($feeder){
            if(password_verify($request->password, $feeder->password)){
                return response()->json([
                    'status' => true,
                    'message' => "Welcome ".$feeder->nama,
                    'data' => $feeder
                ]);
            }
            return $this->error('Password salah');
        }
        return $this->error('Email tidak terdaftar');
    }

    public function register(Request $request){
        $validasi = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:pemesan',
            'password' => 'required|min:6',
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',  
        ]);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this->error($val);
        }

        $pemesan = new Pemesan();
            $pemesan_select = Pemesan::select('id_users');
            $pemesan_count = $pemesan_select->count();
                // if ($operator_count === 1 && $operator->id_users === "admin" ) {
                if ($pemesan_count === 0) {
                    $pemesan->id_users = 'U1';
                }else{
                    // $lastrow = $trip_select->last();
                    $lastrow=$pemesan_select->orderBy('created_at','desc')->first();
                    $lastrow_id = explode('U', $lastrow->id_users);
                    $new_id = $lastrow_id[1]+1;
                    $pemesan->id_users = 'U'.$new_id;
                }
        $pemesan->username = $request->username;
        $pemesan->email = $request->email;
        $pemesan->password = $request->password;
        $pemesan->nama = $request->nama;
        $pemesan->kontak = $request->kontak;
        $pemesan->jenis_kelamin = $request->jenis_kelamin;
        $pemesan->alamat = $request->alamat;
        $pemesan->save();

        if($pemesan){
            return response()->json([
                    'status' => true,
                    'message' => "Register berhasil",
                    'data' => $pemesan
            ]);
        }

        return $this->error("Registrasi gagal");     
    }

    public function pesananSearch(Request $request){
        $tanggal = $request->tanggal;
        $filter = '%'.$tanggal.'%';

        $trip = Trip::where(['id_kota_asal' => $request->id_kota_asal, 
                               'id_kota_tujuan' => $request->id_kota_tujuan,])
                    ->where('jadwal', 'like', $filter)
                    ->get();

        $trip_booking = Trip::join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
                    ->where(['id_kota_asal' => $request->id_kota_asal, 
                               'id_kota_tujuan' => $request->id_kota_tujuan,])
                    ->where('jadwal', 'like', $filter)
                    ->where('detail_pesanan.status', '!=', 5)
                    ->select('detail_pesanan.id_seat')
                    ->count();
        $seat_available = ($trip->count() * 7) - $trip_booking;

        if(!$trip->isEmpty() && $seat_available >= $request->jumlah_penumpang){
            return response()->json([
                    'status' => true,
                    'message' => "Trip on  " .$request->tanggal,
                    'data' => $trip
            ]);
        }

        return $this->error("Tidak ada trip");

    }

    public function check(Request $request){

        if(Pesanan::where(['id_trip' => $request->id_trip, 'id_users_pemesan' => $request->id_users_pemesan])->exists()){
            return $this->error("Anda sudah memesan Trip ini. Silakan edit data pesanan anda ");
        }else{
            $trip = Trip::where(['id_trip' => $request->id_trip])->get();
            $jumlah_penumpang = $request->jumlah_penumpang;
            $pemesan = Pemesan::where('id_users', $request->id_users_pemesan)->get();
            $seat = Seat::all();
            $seat_b = Detail_Pesanan::where('id_trip', $request->id_trip)
                        ->where('status', '!=', 5)
                        ->orderBy('id_seat', 'ASC')
                        ->get();
            $seat_tersedia = 7 - ($seat_b->count());
            
            if($seat_tersedia == 0){
                return $this->error("Trip ini sudah penuh");
            }else if($seat_tersedia >= $jumlah_penumpang){
                return response()->json([
                    'status' => true,
                    'message' => "Silakan isi data penumpang"
            ]);  
            }else if($seat_tersedia < $jumlah_penumpang){
                return $this->error("Hanya " .$seat_tersedia. " seat yang tersedia");
            }
        }
    }

    public function seat(Request $request){
        $seat = Detail_Pesanan::where('id_trip', $request->id_trip)
                    ->where('status', '!=', 5)
                    ->orderBy('id_seat', 'ASC')                    
                    ->get();
        
        return response()->json([
                'status' => true,
                'message' => "Data seat di Trip ".$request->id_trip,
                'data' => $seat
        ]);  
    }

    public function tripSopir(Request $request){
        $today = Carbon::today();

        $trip = Trip::where('id_users_sopir', $request->id_users)
                    ->where('jadwal', '>=', $today)
                    ->orderBy('jadwal', 'ASC')
                    ->get();
                  
        return response()->json([
                'status' => true,
                'message' => "Trip Sopir ".$request->id_users,
                'data' => $trip
        ]);  
    }

    public function riwayatTripSopir(Request $request){
        $today = Carbon::today();

        $trip = Trip::where('id_users_sopir', $request->id_users)
                    ->where('jadwal', '<=', $today)
                    ->orderBy('jadwal', 'DESC')
                    ->get();
     
        return response()->json([
                'status' => true,
                'message' => "Trip Sopir ".$request->id_users,
                'data' => $trip
        ]);  
    }

    public function detailTripSopir(Request $request){
        $detail = DB::table('detail_pesanan')
                    ->join('pesanan', function ($join) {
                        $join->on('detail_pesanan.id_pesanan', '=', 'pesanan.id_pesanan')->On('detail_pesanan.id_trip', '=', 'pesanan.id_trip');
                      })
                     ->join('pemesan', 'pesanan.id_users_pemesan', '=', 'pemesan.id_users')
                    ->where('detail_pesanan.id_trip', $request->id_trip)
                    ->where('status', '!=', 5)
                    ->select('detail_pesanan.id_trip', 
                             'detail_pesanan.id_pesanan',
                             'detail_pesanan.nama_penumpang',
                             'detail_pesanan.jenis_kelamin',
                             'detail_pesanan.id_seat',
                             'detail_pesanan.detail_asal',
                             'detail_pesanan.detail_tujuan',
                             'detail_pesanan.no_hp',
                             'detail_pesanan.status',
                             'detail_pesanan.biaya_tambahan',
                             'pemesan.kontak as kontak_pemesan')
                    ->orderBy('id_seat', 'ASC')
                    ->get();

        $today = Carbon::today();            

        if(!$detail->isEmpty()){
            return response()->json([
                'status' => true,
                'message' => "Detail trip ".$request->id_trip,
                'data' => $detail
            ]);
        }                         

        return $this->error("Belum ada pemesan di trip ini");
    }

    public function Feeder(Request $request){
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

        if(!$detail->isEmpty()){
            return response()->json([
                'status' => true,
                'message' => "Feeder ".$request->id_users_feeder,
                'data' => $detail
            ]);
        }                         
        return $this->error("Belum ada penumpang yang akan dijemput");     
    }


    public function changeStatus(Request $request){
        $detail = Detail_Pesanan::where(['id_pesanan' => $request->id_pesanan, 'id_trip' => $request->id_trip, 'id_seat' => $request->id_seat])->first();
        $status = $request->status;
        $detail->status = $status;
        $detail->save();

        if($detail){
            return response()->json([
                    'status' => true,
                    'message' => "Data berhasil diupdate",
                    'data' => $detail
            ]);
        }

        return $this->error("Data gagal diupdate");
    }

    public function updateDataPemesan(Request $request){
        $pemesan = Pemesan::where('id_users', $request->id_users)->first();
                
        $pemesan->username = $request->username;
        $pemesan->email = $request->email;
        $pemesan->nama = $request->nama;
        $pemesan->kontak = $request->kontak;
        $pemesan->jenis_kelamin = $request->jenis_kelamin;
        $pemesan->alamat = $request->alamat;
        $pemesan->save();

        if($pemesan){
            return response()->json([
                    'status' => true,
                    'message' => "Data berhasil diupdate",
                    'data' => $pemesan
            ]);
        }

        return $this->error("Data gagal diupdate");
    }


        
    public function error($pesan){
        return response()->json([
            'status' => false,
            'message' => $pesan
        ]);
    }    
            
	//Pemesan
    public function riwayatTripPemesan(Request $request){
        $pesanan = Pesanan::join('trip', 'pesanan.id_trip', '=', 'trip.id_trip')
                        ->where('pesanan.id_users_pemesan',  $request->id_users_pemesan)
                        ->get();

        $pemesan = Pemesan::where('id_users', $request->id_users_pemesan)->first();   
                     
        if(!$pesanan->isEmpty()){
            return response()->json([
                    'status' => true,
                    'message' => "Riwayat Trip Pemesan  " .$pemesan->id_users,
                    'data' => $pesanan
            ]);
        }

        return $this->error("Belum ada pesanan");
    }

    public function detailRiwayatTripPemesan(Request $request){
        
        $detail = Detail_Pesanan::join('trip', 'detail_pesanan.id_trip', '=', 'trip.id_trip')
                        ->where('detail_pesanan.id_pesanan',  $request->id_pesanan)
                        ->get();

        if(!$detail->isEmpty()){
            return response()->json([
                    'status' => true,
                    'message' => "Detail order  " .$request->id_pesanan,
                    'data' => $detail
            ]);
        }

        return $this->error("Belum ada detail");
    }

    // public function riwayatTripPemesan($id_users_pemesan){
    //     $pesanan = Pesanan::join('detail_pesanan', 'pesanan.id_pesanan', 'detail_pesanan.id_pesanan')
    //                 ->where('pesanan.id_users_pemesan', $id_users_pemesan)
    //                 ->get();
    //     return response($pesanan);
    // }

    // public function lihatTrip(Request $request){
    //     $input = $request->all();
    //     $tanggal = $input['tanggal'];
    //     $filter = '%'.$tanggal.'%';
    //     $jumlah_penumpang = $input['jumlah_penumpang'];
    //     $trip = Trip::where(['id_kota_asal' => $input['id_kota_asal'], 
    //                            'id_kota_tujuan' => $input['id_kota_tujuan']])
    //                 ->where('jadwal', 'like', $filter)
    //                 ->get();

    //     $seat_a = Trip::join('detail_pesanan', 'trip.id_trip', 'detail_pesanan.id_trip')
    //                 ->where(['id_kota_asal' => $input['id_kota_asal'], 
    //                            'id_kota_tujuan' => $input['id_kota_asal']])
    //                 ->where('jadwal', 'like', $filter)
    //                 ->where('detail_pesanan.status', '!=', 5)
    //                 ->select('detail_pesanan.id_seat')
    //                 ->count();

    //     $seat = ($trip->count() * 7) - $seat_a;

    //     if(!$trip->isEmpty() && $seat >= $jumlah_penumpang){
    //         return response($trip);
    //     }else{
    //         return("Tidak ada trip");
    //     }                          
    // }

    public function createDetail($jumlah_penumpang, $id_trip, $id_users_pemesan, Request $request){

        $trip = Trip::where(['id_trip' => $id_trip])->get();
        $seat = $request->id_seat;

        if (Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $seat]))
                          ->where('status', '!=', 5)
                          ->exists(){
            return $this->error("Seat sudah dibooking");
        }else{
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
            $pesanan->id_users_operator = 'O4';
            $pesanan->save();

            foreach($request->nama_penumpang as $key => $value){
                    Detail_Pesanan::create([
                        'id_trip' => $pesanan->id_trip,
                        'id_seat' => Input::get('id_seat'),
                        'id_pesanan' => $pesanan->id_pesanan,
                        'nama_penumpang' => Input::get('nama_penumpang'),
                        'jenis_kelamin' => Input::get('jenis_kelamin'),
                        'detail_asal' => Input::get('detai_asal'),
                        'detail_tujuan' => Input::get('detail_tujuan'),
                        'no_hp' => Input::get('no_hp'),
                        'biaya_tambahan' => Input::get('biaya_tambahan'),
                        'status' => 1
                        ]);
            }
        }

        return response()->json([
                'status' => true,
                'message' => "Berhasil menyimpan data",
                'data' => $pesanan
            ]);



    }

    //     // $jumlah_penumpang = $request->jumlah_penumpang;
    //     // $id_trip = $request->id_trip;
    //     // $id_users_pemesan = $request->id_users_pemesan;



    //     if(Detail_Pesanan::where(['id_trip' => $id_trip, 'id_seat' => $seat])
    //             ->where('status', '!=', 5)
    //             ->exists()) {
                       
    //         return $this->error("Seat sudah dibooking");
    //     }else{
    //             // dd("Seat belum ada, bisa pesan. Atau seat sebelumnya sudah dicancel");
    //                 $pesanan = new Pesanan();
    //                 $pesanan_select = Pesanan::select('id_pesanan');
    //                 $pesanan_count = $pesanan_select->count();
    //                     if ($pesanan_count === 0) {
    //                         $pesanan->id_pesanan = 'P1';
    //                     }else{
    //                         $lastrow=$pesanan_select->orderBy('created_at','desc')->first();
    //                         $lastrow_id = explode('P', $lastrow->id_pesanan);
    //                         $new_id = $lastrow_id[1]+1;
    //                         $pesanan->id_pesanan = 'P'.$new_id;
    //                     }
    //             $pesanan->id_trip = $id_trip;
    //             $pesanan->id_users_pemesan = $id_users_pemesan;            
    //             $pesanan->tanggal_pesan = date('Y-m-d H:i:s');
    //             $pesanan->id_users_operator = 'O4';
    //             $pesanan->save();

    //             // foreach($request->nama_penumpang as $key => $value){
    //             //     Detail_Pesanan::create([
    //             //         'id_trip' => $pesanan->id_trip,
    //             //         'id_seat' => $request->id_seat[$key],
    //             //         'id_pesanan' => $pesanan->id_pesanan,
    //             //         'nama_penumpang' => $request->nama_penumpang[$key],
    //             //         'jenis_kelamin' => $request->jenis_kelamin[$key],
    //             //         'detail_asal' => $request->detail_asal[$key],
    //             //         'detail_tujuan' => $request->detail_tujuan[$key],
    //             //         'no_hp' => $request->no_hp[$key],
    //             //         'biaya_tambahan' => $request->biaya_tambahan[$key],
    //             //         'status' => 1
    //             //         ]);
    //             // }

    //             foreach($request->nama_penumpang as $key => $value){
    //                 Detail_Pesanan::create([
    //                     'id_trip' => $pesanan->id_trip,
    //                     'id_seat' => Input::get('id_seat'),
    //                     'id_pesanan' => $pesanan->id_pesanan,
    //                     'nama_penumpang' => Input::get('nama_penumpang'),
    //                     'jenis_kelamin' => Input::get('jenis_kelamin'),
    //                     'detail_asal' => Input::get('detai_asal'),
    //                     'detail_tujuan' => Input::get('detail_tujuan'),
    //                     'no_hp' => Input::get('no_hp'),
    //                     'biaya_tambahan' => Input::get('biaya_tambahan'),
    //                     'status' => 1
    //                     ]);
    //             }    
                
    //             // foreach($request as $value){
    //             //     Detail_Pesanan::create([
    //             //         'id_trip' => $pesanan->id_trip,
    //             //         'id_seat' => $value->id_seat,
    //             //         'id_pesanan' => $pesanan->id_pesanan,
    //             //         'nama_penumpang' => $value->nama_penumpang,
    //             //         'jenis_kelamin' => $value->jenis_kelamin,
    //             //         'detail_asal' => $value->detai_asal,
    //             //         'detail_tujuan' => $value->detail_tujuan,
    //             //         'no_hp' => $value->no_hp,
    //             //         'biaya_tambahan' => $value->biaya_tambahan,
    //             //         'status' => 1
    //             //         ]);
    //             // }
                
                

    //             // Detail_Pesanan::insert($pesanan);
    //         return response()->json([
    //             'status' => true,
    //             'message' => "Berhasil menyimpan data",
    //             'data' => $pesanan
    //         ]);

    //     }
    // }


    public function getBookedSeat(Request $request){
       
        $bookedSeat = Detail_Pesanan::join('trip', 'detail_pesanan.id_seat', '=', 'trip.id_trip')
                    ->where('trip.id_trip', $request->id_trip)
                    ->where('detail_pesanan.status', '!=', 5)
                    ->select('detail_pesanan.id_seat')
                    ->orderBy('id_seat', 'ASC')         
                    ->first();

        return response()->json([
                'status' => true,
                'message' => "Seat yang sudah dibooking di trip  ".$request->id_trip,
                'data' => $bookedSeat
        ]);              

    }




        // if(Pesanan::where(['id_trip' => $request->id_trip, 'id_users_pemesan' => $request->id_users_pemesan])->exists()){
        //     return $this->error('Data penumpang sudah ada di trip ini');

        // }else{
        //     $trip = Trip::where('id_trip', $request->id_trip)->get();
        //     $pemesan = Pemesan::where('id_users', $request->id_users_pemesan)->get();
        //     $seat_b = Detail_Pesanan::where('id_trip', $request->id_trip)
        //                 ->where('status', '!=', 5)
        //                 ->orderBy('id_seat', 'ASC')
        //                 ->get();
        //     $seat_tersedia = 7 - ($seat_b->count());
            
        //     if($seat_tersedia == 0){
        //          return $this->error('Trip ini sudah penuh');
        //     }else if($seat_tersedia >= $request->jumlah_penumpang){
        //          return response()->json([
        //             'status' => true,
        //             'message' => "Bisa Pesan",
        //             'data' => $pemesan
        //         ]);   
        //     }else if($seat_tersedia < $request->jumlah_penumpang){
        //         return $this->error('Hanya ' .$seat_tersedia. ' seat yang tersedia');
        //     }
        // }
    }

    // public function editPesanan(Request $request){
    //     $pesanan = Pesanan::where(['id_pesanan' => $request->id_pesanan, 'id_trip' => $request->id_trip])->first();
    // }

    public function lihatTrip(Request $request){
        return "Api berhasil"; 
        
    }

    // public function create_pesanan(Request $request){
    // 	$pesanan = new Pesanan;
    // 		$pesanan_select = Pesanan::select('id_pesanan');
    // 		$pesanan_count = $pesanan_select->count();
    // 			if($pesanan_count === 0){
    // 				$pesanan->id_pesanan = 'P1';
    // 			}else{
    // 				$lastrow = $pesanan_select->orderBy('created_at', 'desc')->first();
    // 				$lastrow_id = explode('P', $lastrow->id_pesanan);
    // 				$new_id = $lastrow_id[1]+1;
    // 				$pesanan->id_pesanan = 'P'.$new_id;
    // 			}
    //     $pesanan->id_pesanan = $request->id_pesanan;
    // 	$pesanan->id_trip = $request->id_trip;
    // 	$pesanan->id_users_pemesan = $request->id_users_pemesan;
    // 	$pesanan->tanggal_pesan = date('Y-m-d H:i:s');
    // 	$pesanan->id_users_operator = $request->id_users;
    //     $pesanan->save();

    //     foreach($request->nama_penumpang as $key => $value){
    //                 Detail_Pesanan::create([
    //                     'id_trip' => $pesanan->id_trip,
    //                     'id_seat' => $request->id_seat[$key],
    //                     'id_pesanan' => $pesanan->id_pesanan,
    //                     'nama_penumpang' => $request->nama_penumpang[$key],
    //                     'jenis_kelamin' => $request->jenis_kelamin[$key],
    //                     'detail_asal' => $request->detail_asal[$key],
    //                     'detail_tujuan' => $request->detail_tujuan[$key],
    //                     'no_hp' => $request->no_hp[$key],
    //                     'biaya_tambahan' => $request->biaya_tambahan[$key],
    //                     'status' => 1
    //                 ]);
    //     }

    // }

    // public function update_pesanan(Request $request{
    // 	foreach($request->nama_penumpang as $key => $value){
    //                 Detail_Pesanan::create([
    //                     'id_trip' => $id_trip,
    //                     'id_seat' => $request->id_seat[$key],
    //                     'id_pesanan' => $id_pesanan,
    //                     'nama_penumpang' => $request->nama_penumpang[$key],
    //                     'jenis_kelamin' => $request->jenis_kelamin[$key],
    //                     'detail_asal' => $request->detail_asal[$key],
    //                     'detail_tujuan' => $request->detail_tujuan[$key],
    //                     'no_hp' => $request->no_hp[$key],
    //                     'biaya_tambahan' => $request->biaya_tambahan[$key],
    //                     'status' => 1
    //                 ]);
    //             }
    // }

    // public function create_seat(Request $request){
    // 	$seat = new Seat;
    //     $seat->id_seat = $request->id_seat;
    //     $seat->keterangan = $request->keterangan;
    //     $seat->save();

    //     return "Berhasil";
    // }

}
