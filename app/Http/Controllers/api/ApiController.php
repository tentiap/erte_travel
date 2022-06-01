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
use App\Mobil;


use DB;
use Carbon\Carbon;

class ApiController extends Controller
{   
     //Done
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
    //Done
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
     //Done
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
                    ->where('trip.jadwal', 'like', $filter)
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
     //Done
    public function check(Request $request){

        if(Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil, 'id_pemesan' => $request->id_pemesan])->exists()){ 
            return $this->error("Anda sudah memesan Trip ini. Silakan edit data pesanan anda ");
        }else{
            $trip = Trip::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil])->get();
            $jumlah_penumpang = $request->jumlah_penumpang;
            $pemesan = Pemesan::where('id_pemesan', $request->id_pemesan)->get();
            $seat = Seat::all();
            $seat_b = Detail_Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil])
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
     //Done
     public function check_update(Request $request){

            $trip = Trip::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil])->get();
            $tambah = $request->tambah;
            $pemesan = Pemesan::where('id_pemesan', $request->id_pemesan)->get();
            $seat = Seat::all();
            $seat_b = Detail_Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil])
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

    //Done
    public function seat(Request $request){
        $seat = Detail_Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil])
                    ->where('status', '!=', 5)
                    ->orderBy('id_seat', 'ASC')                    
                    ->get();
        
        return response()->json([
                'status' => true,
                'message' => "Data seat",
                'data' => $seat
        ]);  

    }

    //Done
    public function updateDataPemesan(Request $request){
        $pemesan = Pemesan::where('id_pemesan', $request->id_pemesan)->first();
                
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

    //Done
    public function checkAvailableSeat(Request $request){
        
        $bookedSeat = Detail_Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil])
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
            
    //Done
    public function riwayatTripPemesan(Request $request){

        $pesanan = Pesanan::join('trip', ['pesanan.jadwal' => 'trip.jadwal', 'pesanan.plat_mobil' => 'trip.plat_mobil'])
                        ->where('pesanan.id_pemesan',  $request->id_pemesan)
                        ->orderBy('trip.jadwal', 'desc')
                        ->get();
        // dd($pesanan->count());
        // $jumlah_pesanan = $pesanan->count();

        if(!empty($pesanan)){
            for($i=0; $i < $pesanan->count(); $i++) {
                $detail = Detail_Pesanan::where(['jadwal' => $pesanan[$i]->jadwal, 'plat_mobil' => $pesanan[$i]->plat_mobil, 'id_pemesan' => $pesanan[$i]->id_pemesan])->get();

                if($detail->isEmpty()) {
                    $pesanan[$i]->delete();
                } 
            }
        }

        $pemesan = Pemesan::where('id_pemesan', $request->id_pemesan)->first();                
        if(!$pesanan->isEmpty()){
            return response()->json([
                    'status' => true,
                    'message' => "Riwayat Trip Pemesan  " .$pemesan->id_pemesan,
                    'data' => $pesanan
            ]);
        }

        return $this->error("Belum ada pesanan");
    }

    //Done
    public function detailRiwayatTripPemesan(Request $request){
        
        $detail = Detail_Pesanan::join('trip', ['detail_pesanan.plat_mobil' =>'trip.plat_mobil', 'detail_pesanan.jadwal' => 'trip.jadwal'])
                        ->where('detail_pesanan.jadwal', $request->jadwal)
                        ->where('detail_pesanan.plat_mobil', $request->plat_mobil)
                        ->where('detail_pesanan.id_pemesan', $request->id_pemesan)
                        ->orderBy('detail_pesanan.status', 'asc')
                        ->get();
        
                        // dd($detail);

        if(!$detail->isEmpty()){
            return response()->json([
                    'status' => true,
                    'message' => "Detail order  ",
                    'data' => $detail
            ]);
        }

        return $this->error("Belum ada detail");
    }

    //Done
    public function create_pesanan(Request $request){
        
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
        $pesanan->id_pemesan = $request->id_pemesan;   
        $pesanan->jadwal = $request->jadwal;
        $pesanan->plat_mobil = $request->plat_mobil;         
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
        // $detail_pesanan =  Detail_Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil, 'id_seat' => $request->id_seat])->get();

        // if (count($detail_pesanan) > 0 ){
        //     $lastOrderNumber = Detail_Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil, 'id_seat' => $request->id_seat])
        //                         ->orderBy('order_number','desc')
        //                         ->first();
            
        //     $newOrderNumber = $lastOrderNumber->order_number + 1;
            
        // }elseif(count($detail_pesanan) == 0 ) {
        //     $newOrderNumber = 1;
        // }
        
        $detail_pesanan = new Detail_Pesanan();
        $detail_pesanan->jadwal =  $request->jadwal;
        $detail_pesanan->plat_mobil = $request->plat_mobil;
        $detail_pesanan->id_seat = $request->id_seat;
        // $detail_pesanan->order_number = $newOrderNumber;
        $detail_pesanan->id_pemesan = $request->id_pemesan;
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

    public function changeStatus(Request $request){
        $booked = Detail_Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil, 'id_seat' => $request->id_seat, 'id_pemesan' => $request->id_pemesan])
                            ->where('status', '!=', 5)
                            ->get();

        // json_decode($booked, true);
        // if(count($booked) > 0) {
        //     if(($request->status != 5) && ($request->order_number != $booked[0]['order_number'])) {
        //         return $this->error("Seat ".$request->id_seat." sudah dibooking");
        //     } 
        // }

        $detail = Detail_Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil, 'id_seat' => $request->id_seat, 'id_pemesan' => $request->id_pemesan])->first();

        $status = $request->status;
        $detail->status = $status;
        if($status == '5') {
            $detail->delete();
        } else {
            $detail->save();
        }

        if($detail){
            return response()->json([
                    'status' => true,
                    'message' => "Data berhasil diupdate",
                    'data' => $detail
            ]);
        }

        return $this->error("Data gagal diupdate");
    }

    public function updateDetailPesanan(Request $request){

        $detail_pesanan = Detail_Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil, 
                                                 'id_seat' => $request->current_seat, 'id_pemesan' => $request->id_pemesan])->first();

        if($request->status == '5') {
            $detail_pesanan->delete();
        } else {

            $detail_pesanan->id_seat = $request->id_seat;

            // dd($request->nama_penumpang);

            $detail_pesanan->nama_penumpang = $request->nama_penumpang;
            $detail_pesanan->jenis_kelamin = $request->jenis_kelamin;
            $detail_pesanan->detail_asal = $request->detail_asal;
            $detail_pesanan->detail_tujuan = $request->detail_tujuan;
            $detail_pesanan->no_hp = $request->no_hp;
            $detail_pesanan->status = $request->status;
            $detail_pesanan->save();
        }

        if($detail_pesanan){
            return response()->json([
                    'status' => true,
                    'message' => "Update Detail Pesanan berhasil",
                    'data' => $detail_pesanan
            ]);
        }

        return $this->error("Data gagal diupdate");

    }

    //Done
    public function getIdPesanan(Request $request){
        
        $pesanan = Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil, 
                        'id_pemesan' => $request->id_pemesan])
                        ->get();

        // $pesanan = Pesanan::all();
        // $id_pesanan = $pesanan->jadwal."".$pesanan->plat_mobil."".$pesanan->id_pemesan;

        // dd($id_pesanan);


        if($pesanan){
            return response()->json([
                    'status' => true,
                    'message' => "Berhasil mengambil Data Pesanan",
                    'data' => $pesanan
            ]);
        }
    }

    //Done
    public function getDetailPesanan(Request $request){
        
        $detail = Detail_Pesanan::where(['jadwal' => $request->jadwal, 'plat_mobil' => $request->plat_mobil, 
        'id_pemesan' => $request->id_pemesan])->orderBy('id_seat', 'ASC')->get();


        if($detail){
            return response()->json([
                    'status' => true,
                    'message' => "Berhasil mengambil Data Detail Pesanan",
                    'data' => $detail
            ]);
        }
    }

    //Done
    public function getBookedSeat(Request $request){
       
        $bookedSeat = Detail_Pesanan::join('trip', ['trip.jadwal' => "detail_pesanan.jadwal", 'trip.plat_mobil' => "detail_pesanan.plat_mobil"])
                    ->where(['trip.jadwal' => $request->jadwal, 'trip.plat_mobil' => $request->plat_mobil])
                    ->where('detail_pesanan.status', '!=', 5)
                    ->select('detail_pesanan.id_seat')
                    ->orderBy('id_seat', 'ASC')         
                    ->get();

        return response()->json([
                'status' => true,
                'message' => "Seat yang sudah dibooking",
                'data' => $bookedSeat
        ]);              

    }

    //Done
    public function loginSopir(Request $request){
        $sopir = Sopir::join('mobil', 'sopir.plat_mobil', '=', 'mobil.plat_mobil')->where('email', $request->email)->first();

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

    //Done
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

    //Done
    public function tripSopir(Request $request){

        $today = Carbon::today();

        // $trip = Trip::where('id_sopir', $request->id_sopir)
        //             ->where('jadwal', '>=', $today)
        //             ->orderBy('jadwal', 'ASC')
        //             ->get();

        $trip = Trip::join('mobil', 'trip.plat_mobil', '=', 'mobil.plat_mobil')
                    ->join('sopir', 'mobil.plat_mobil', '=', "sopir.plat_mobil")
                    ->where(['sopir.id_sopir' => $request->id_sopir])
                    ->where('trip.jadwal', '>=', $today)
                    ->orderBy('trip.jadwal', 'ASC')
                    ->get();
                  
        return response()->json([
                'status' => true,
                'message' => "Trip Sopir ",
                'data' => $trip
        ]);  

    }

    public function riwayatTripSopir(Request $request){

        $today = Carbon::today();

        // $trip = Trip::where('id_sopir', $request->id_sopir)
        //             ->where('jadwal', '<=', $today)
        //             ->orderBy('jadwal', 'DESC')
        //             ->get();

        $trip = Trip::join('mobil', 'trip.plat_mobil', '=', 'mobil.plat_mobil')
                    ->join('sopir', 'mobil.plat_mobil', '=', "sopir.plat_mobil")
                    ->where(['sopir.id_sopir' => $request->id_sopir])
                    ->where('sopir.id_sopir', $request->id_sopir)
                    ->orderBy('trip.jadwal', 'DESC')
                    ->get();

        return response()->json([
                'status' => true,
                'message' => "Trip Sopir ".$request->id_sopir,
                'data' => $trip
        ]);  

    }

    public function detailTripSopir(Request $request){

        $detail = DB::table('detail_pesanan')
                    ->join('pesanan', function ($join) {
                        $join->on('detail_pesanan.jadwal', '=', 'pesanan.jadwal');
                        $join->on('detail_pesanan.plat_mobil', '=', 'pesanan.plat_mobil');
                        $join->on('detail_pesanan.id_pemesan', '=', 'pesanan.id_pemesan');
                      })
                    ->join('pemesan', 'pesanan.id_pemesan', '=', 'pemesan.id_pemesan')
                    ->join('trip', ['trip.jadwal' => 'detail_pesanan.jadwal', 'trip.plat_mobil' => "detail_pesanan.plat_mobil"])
                    ->where(['trip.jadwal' => $request->jadwal, 'trip.plat_mobil' => $request->plat_mobil])
                    ->where('status', '!=', 5)
                    ->select('detail_pesanan.jadwal', 
                             'detail_pesanan.plat_mobil',
                             'detail_pesanan.id_pemesan',
                             'detail_pesanan.nama_penumpang',
                             'detail_pesanan.jenis_kelamin',
                             'detail_pesanan.id_seat',
                             'detail_pesanan.detail_asal',
                             'detail_pesanan.detail_tujuan',
                             'detail_pesanan.no_hp',
                             'detail_pesanan.status',
                            //  'detail_pesanan.order_number',
                             'detail_pesanan.biaya_tambahan',
                             'pemesan.kontak as kontak_pemesan')
                    ->orderBy('id_seat', 'ASC')
                    ->get();

        $today = Carbon::today();            

        if(!$detail->isEmpty()){
            return response()->json([
                'status' => true,
                'message' => "Detail trip ",
                'data' => $detail
            ]);
        }                         

        return $this->error("Belum ada pemesan di trip ini");

    }

    //Done
    public function Feeder(Request $request){
        //Trip 2 jam yang akan datang (dari jam sekarang)
        $carbonTrip = Carbon::now()->addHours(2)->toDateTimeString();
        
        $detail = DB::table('detail_pesanan')
                    ->join('pesanan', function ($join) {
                        $join->on('detail_pesanan.jadwal', '=', 'pesanan.jadwal');
                        $join->on('detail_pesanan.plat_mobil', '=', 'pesanan.plat_mobil');
                        $join->on('detail_pesanan.id_pemesan', '=', 'pesanan.id_pemesan');
                      })
                    ->join('pemesan', 'pesanan.id_pemesan', '=', 'pemesan.id_pemesan')
                    ->join('trip', ['trip.jadwal' => 'detail_pesanan.jadwal', 'trip.plat_mobil' => "detail_pesanan.plat_mobil"])
                    ->where('detail_pesanan.id_feeder', $request->id_feeder)
                    ->where('detail_pesanan.status', '!=', 5)
                    ->whereBetween('trip.jadwal', [Carbon::now(), $carbonTrip])
                    ->select('detail_pesanan.jadwal', 
                             'detail_pesanan.plat_mobil',
                             'detail_pesanan.id_pemesan',
                             'detail_pesanan.nama_penumpang',
                             'detail_pesanan.jenis_kelamin',
                             'detail_pesanan.id_seat',
                             'detail_pesanan.detail_asal',
                             'detail_pesanan.no_hp',
                             'detail_pesanan.status',
                             'detail_pesanan.biaya_tambahan',
                            //  'detail_pesanan.order_number',
                             'pemesan.kontak',
                             'trip.jadwal')
                    ->orderBy('trip.jadwal', 'ASC')
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



}