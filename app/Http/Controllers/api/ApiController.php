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
        // $feeder = Feeder::where('email', $request->email)->first();
        // $trip = Trip::where(['id_kota_asal' => $request->id_kota_asal, 
        //                        'id_kota_tujuan' => $request->id_kota_tujuan,])
        //             ->where('jadwal', 'like', $filter)
        //             ->get();
        $trip = Trip::join('sopir', 'trip.id_users_sopir', 'sopir.id_users')
                    ->where(['id_kota_asal' => $request->id_kota_asal, 
                               'id_kota_tujuan' => $request->id_kota_tujuan,])
                    ->where('jadwal', 'like', $filter)
                    ->get();

        // $trip = Trip::join('kota', function($join){
        //     $join->on('trip.id_kota_asal', '=', 'kota.id_kota')
        //          ->orOn('trip.id_kota_tujuan', '=', 'kota.id_kota')})
        //             ->where(['id_kota_asal' => $request->id_kota_asal, 
        //                        'id_kota_tujuan' => $request->id_kota_tujuan,])
        //             ->where('jadwal', 'like', $filter)
        //             ->get();


        $trip_booking = Trip::join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
                    ->where(['id_kota_asal' => $request->id_kota_asal, 
                               'id_kota_tujuan' => $request->id_kota_tujuan,])
                    ->where('jadwal', 'like', $filter)
                    ->where('detail_pesanan.status', '!=', 5)
                    ->select('detail_pesanan.id_seat')
                    ->count();
        $seat_available = ($trip->count() * 7) - $trip_booking;

        // return response()->json([
        //     'success' => 1,
        //     'message' => $seat_available,
        //     'user' => $trip
        // ]);

        if(!$trip->isEmpty() && $seat_available >= $request->jumlah_penumpang){
            return response()->json($trip);
        }else{
            return "Tidak ada trip";
        }  

        // if($feeder){
        //     if(password_verify($request->password, $feeder->password)){
        //         return response()->json([
        //             'success' => 1,
        //             'message' => "Welcome ".$feeder->nama,
        //             'user' => $feeder
        //         ]);
        //     }
        //     return $this->error('Password salah');
        // }
        // return $this->error('Email tidak terdaftar');
    }

    public function error($pesan){
        return response()->json([
            'status' => false,
            'message' => $pesan
        ]);
    }    
            
        

        // $input = $request->all();
        // if (Auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        //         $pemesan = Auth()->pemesan();
        //         $pemesan->api_token = str_random(60);
        //         $pemesan->save();
        //         return $pemesan;
        // }
    
        // return response()->json([
        //     'error' => 'Unauthenticated user',
        //     'code' => 401,
        // ], 401);

    // }

	//Pemesan
    public function riwayatTripPemesan(Request $request){
    	
        // $pesanan = Pesanan::where('id_users_pemesan', $request->id_users_pemesan)->get();
        $pesanan = Pesanan::join('trip', 'pesanan.id_trip', '=', 'trip.id_trip')
                        ->join('detail_pesanan', 'pesanan.id_pesanan', 'detail_pesanan.id_pesanan')
                        ->where('pesanan.id_users_pemesan',  $request->id_users_pemesan)
                        ->get();
    	
        if(!$pesanan->isEmpty()){
            return response()->json([
                    'status' => true,
                    'message' => "Riwayat Trip Pemesan",
                    'data' => $pesanan
            ]);
        }

        return $this->error("Belum ada pesanan");
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

    public function createDetail(Request $request){

        if(Pesanan::where(['id_trip' => $request->id_trip, 'id_users_pemesan' => $request->id_users_pemesan])->exists()){
            return $this->error('Data penumpang sudah ada di trip ini');

        }else{
            $trip = Trip::where('id_trip', $request->id_trip)->get();
            $pemesan = Pemesan::where('id_users', $request->id_users_pemesan)->get();
            $seat_b = Detail_Pesanan::where('id_trip', $request->id_trip)
                        ->where('status', '!=', 5)
                        ->orderBy('id_seat', 'ASC')
                        ->get();
            $seat_tersedia = 7 - ($seat_b->count());
            
            if($seat_tersedia == 0){
                 return $this->error('Trip ini sudah penuh');
            }else if($seat_tersedia >= $request->jumlah_penumpang){
                 return response()->json([
                    'status' => true,
                    'message' => "Bisa Pesan",
                    'data' => $pemesan
                ]);   
            }else if($seat_tersedia < $request->jumlah_penumpang){
                return $this->error('Hanya ' .$seat_tersedia. ' seat yang tersedia');
            }
        }
    }

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
