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
            'id_pemesan' => 'required',
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
            // $pemesan_select = Pemesan::select('id_users');
            // $pemesan_count = $pemesan_select->count();
            //     // if ($operator_count === 1 && $operator->id_users === "admin" ) {
            //     if ($pemesan_count === 0) {
            //         $pemesan->id_users = 'U1';
            //     }else{
            //         // $lastrow = $trip_select->last();
            //         $lastrow=$pemesan_select->orderBy('created_at','desc')->first();
            //         $lastrow_id = explode('U', $lastrow->id_users);
            //         $new_id = $lastrow_id[1]+1;
            //         $pemesan->id_users = 'U'.$new_id;
            //     }

        $pemesan->id_pemesan = $request->id_pemesan;
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

        $today = Carbon::now();
        $filter_jam = date('Y-m-d H:i:s', strtotime($today));

        $trip = Trip::where(['id_kota_asal' => $request->id_kota_asal, 
                               'id_kota_tujuan' => $request->id_kota_tujuan,])
                    ->where('jadwal', 'like', $filter)
                    ->where('jadwal', '>', $filter_jam)
                    ->orderBy('jadwal', 'asc')
                    ->get();

    
        $trip_booking = Trip::join('detail_pesanan', ['trip.jadwal' => 'detail_pesanan.jadwal', 'trip.plat_mobil' => 'detail_pesanan.plat_mobil'])
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
    //sampai sini
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

     public function check_update(Request $request){

            $trip = Trip::where(['id_trip' => $request->id_trip])->get();
            $tambah = $request->tambah;
            $pemesan = Pemesan::where('id_users', $request->id_users_pemesan)->get();
            $seat = Seat::all();
            $seat_b = Detail_Pesanan::where('id_trip', $request->id_trip)
                        ->where('status', '!=', 5)
                        ->orderBy('id_seat', 'ASC')
                        ->get();
            $seat_tersedia = 7 - ($seat_b->count());
            
            if($seat_tersedia == 0){
                return $this->error("Trip ini sudah penuh");
            }else if($seat_tersedia >= $tambah){
                return response()->json([
                    'status' => true,
                    'message' => "Silakan isi data penumpang"
            ]);  
            }else if($seat_tersedia < $tambah){
                return $this->error("Hanya " .$seat_tersedia. " seat yang tersedia");
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
        //Trip 2 jam yang akan datang (dari jam sekarang)
        $carbonTrip = Carbon::now()->addHours(2)->toDateTimeString();
        
        $detail = DB::table('detail_pesanan')
                    ->join('pesanan', function ($join) {
                        $join->on('detail_pesanan.id_pesanan', '=', 'pesanan.id_pesanan')->On('detail_pesanan.id_trip', '=', 'pesanan.id_trip');
                      })
                    ->join('pemesan', 'pesanan.id_users_pemesan', '=', 'pemesan.id_users')
                    ->join('trip', 'pesanan.id_trip', '=', 'trip.id_trip')
                    ->where('detail_pesanan.id_feeder', $request->id_feeder)
                    ->where('detail_pesanan.status', '!=', 5)
                    ->whereBetween('trip.jadwal', [Carbon::now(), $carbonTrip])
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
                'message' => "Feeder ".$request->id_feeder,
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

    public function updateDetailPesanan(Request $request){

        $detail_pesanan = Detail_Pesanan::where('id_detail_pesanan', $request->id_detail_pesanan)->first();
        $detail_pesanan->id_seat = $request->id_seat;
        $detail_pesanan->nama_penumpang = $request->nama_penumpang;
        $detail_pesanan->jenis_kelamin = $request->jenis_kelamin;
        $detail_pesanan->detail_asal = $request->detail_asal;
        $detail_pesanan->detail_tujuan = $request->detail_tujuan;
        $detail_pesanan->no_hp = $request->no_hp;
        $detail_pesanan->status = $request->status;
        $detail_pesanan->save();

        if($detail_pesanan){
            return response()->json([
                    'status' => true,
                    'message' => "Update Detail Pesanan berhasil",
                    'data' => $detail_pesanan
            ]);
        }

        return $this->error("Data gagal diupdate");

    }

    public function checkAvailableSeat(Request $request){
        
        $bookedSeat = Detail_Pesanan::where('id_trip', $request->id_trip)
                        ->where('status', '!=', 5)
                        ->count();

        $seat_available = 7 - $bookedSeat;

        if ($seat_available == 0) {
            return response()->json([
                'status' => false,
                'message' => "Sorry, this trip is fully booked"
            ]);
        }else{
            return response()->json([
                'status' => true,
                'message' => $seat_available. " seat(s) available"
            ]);
        }
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
                        ->orderBy('trip.jadwal', 'desc')
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
                        ->orderBy('detail_pesanan.status', 'asc')
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

    public function create_pesanan(Request $request){
        
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
        $pesanan->id_trip = $request->id_trip;
        $pesanan->id_users_pemesan = $request->id_users_pemesan;            
        $pesanan->tanggal_pesan = date('Y-m-d H:i:s');
        $pesanan->save();

        if($pesanan){
            return response()->json([
                    'status' => true,
                    'message' => "Create Pesanan berhasil",
                    'data' => $pesanan
            ]);
        }
     
    }

    public function create_detail_pesanan(Request $request){
        
        $detail_pesanan = new Detail_Pesanan();
        $detail_pesanan->id_trip =  $request->id_trip;
        $detail_pesanan->id_seat = $request->id_seat;
        $detail_pesanan->id_pesanan = $request->id_pesanan;
        $detail_pesanan->nama_penumpang = $request->nama_penumpang;
        $detail_pesanan->jenis_kelamin = $request->jenis_kelamin;
        $detail_pesanan->detail_asal = $request->detail_asal;
        $detail_pesanan->detail_tujuan = $request->detail_tujuan;
        $detail_pesanan->no_hp = $request->no_hp;
        $detail_pesanan->biaya_tambahan = 0;
        $detail_pesanan->status = 1;
        $detail_pesanan->save();

        if($detail_pesanan){
            return response()->json([
                    'status' => true,
                    'message' => "Create Detail Pesanan berhasil",
                    'data' => $detail_pesanan
            ]);
        }
     
    }

    public function getIdPesanan(Request $request){
        
        $pesanan = Pesanan::where('id_trip', $request->id_trip)
                        ->where('id_users_pemesan', $request->id_users_pemesan)
                        ->select('id_pesanan')
                        ->get();


        if($pesanan){
            return response()->json([
                    'status' => true,
                    'message' => "Berhasil mengambil Id Pesanan",
                    'data' => $pesanan
            ]);
        }
    }

    public function getDetailPesanan(Request $request){
        
        $detail = Detail_Pesanan::where(['id_pesanan' => $request->id_pesanan, 'id_trip' => $request->id_trip])->orderBy('id_seat', 'ASC')->get();


        if($detail){
            return response()->json([
                    'status' => true,
                    'message' => "Berhasil mengambil Data Detail Pesanan",
                    'data' => $detail
            ]);
        }
    }

    public function getBookedSeat(Request $request){
       
        $bookedSeat = Detail_Pesanan::join('trip', 'detail_pesanan.id_trip', '=', 'trip.id_trip')
                    ->where('trip.id_trip', $request->id_trip)
                    ->where('detail_pesanan.status', '!=', 5)
                    ->select('detail_pesanan.id_seat')
                    ->orderBy('id_seat', 'ASC')         
                    ->get();

        return response()->json([
                'status' => true,
                'message' => "Seat yang sudah dibooking di trip  ".$request->id_trip,
                'data' => $bookedSeat
        ]);              

    }

}