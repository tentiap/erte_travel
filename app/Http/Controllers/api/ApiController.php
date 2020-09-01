<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Trip;
use App\Pesanan;
use App\Detail_Pesanan;
use App\Seat;

class ApiController extends Controller
{   
     public function loginPemesan(Request $request){
        // $input = $request->all();
        if (Auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $pemesan = Auth()->pemesan();
                $pemesan->api_token = str_random(60);
                $pemesan->save();
                return $pemesan;
        }
    
        return response()->json([
            'error' => 'Unauthenticated user',
            'code' => 401,
        ], 401);

    }

	//Pemesan
    public function riwayatTrip($id_users_pemesan){
    	$pesanan = Pesanan::join('detail_pesanan', 'pesanan.id_pesanan', 'detail_pesanan.id_pesanan')
                    ->where('pesanan.id_users_pemesan', $id_users_pemesan)
                    ->get();
    	return response($pesanan);
    }

    public function lihatTrip(Request $request){
        $input = $request->all();
        $tanggal = $input['tanggal'];
        $filter = '%'.$tanggal.'%';
        $jumlah_penumpang = $input['jumlah_penumpang'];
        $trip = Trip::where(['id_kota_asal' => $input['id_kota_asal'], 
                               'id_kota_tujuan' => $input['id_kota_asal']])
                    ->where('jadwal', 'like', $filter)
                    ->get();

        $seat_a = Trip::join('detail_pesanan', 'trip.id_trip', 'detail_pesanan.id_trip')
                    ->where(['id_kota_asal' => $input['id_kota_asal'], 
                               'id_kota_tujuan' => $input['id_kota_asal']])
                    ->where('jadwal', 'like', $filter)
                    ->where('detail_pesanan.status', '!=', 5)
                    ->select('detail_pesanan.id_seat')
                    ->count();

        $seat = ($trip->count() * 7) - $seat_a;

        if(!$trip->isEmpty() && $seat >= $jumlah_penumpang){
            return response($trip);
        }else{
            return("Tidak ada trip");
        }                          
    }

    public function create_pesanan(Request $request){
    	$pesanan = new Pesanan;
    		$pesanan_select = Pesanan::select('id_pesanan');
    		$pesanan_count = $pesanan_select->count();
    			if($pesanan_count === 0){
    				$pesanan->id_pesanan = 'P1';
    			}else{
    				$lastrow = $pesanan_select->orderBy('created_at', 'desc')->first();
    				$lastrow_id = explode('P', $lastrow->id_pesanan);
    				$new_id = $lastrow_id[1]+1;
    				$pesanan->id_pesanan = 'P'.$new_id;
    			}
        $pesanan->id_pesanan = $request->id_pesanan;
    	$pesanan->id_trip = $request->id_trip;
    	$pesanan->id_users_pemesan = $request->id_users_pemesan;
    	$pesanan->tanggal_pesan = date('Y-m-d H:i:s');
    	$pesanan->id_users_operator = $request->id_users;
        $pesanan->save();

        foreach($request->nama_penumpang as $key => $value){
                    Detail_Pesanan::create([
                        'id_trip' => $pesanan->id_trip,
                        'id_seat' => $request->id_seat[$key],
                        'id_pesanan' => $pesanan->id_pesanan,
                        'nama_penumpang' => $request->nama_penumpang[$key],
                        'jenis_kelamin' => $request->jenis_kelamin[$key],
                        'detail_asal' => $request->detail_asal[$key],
                        'detail_tujuan' => $request->detail_tujuan[$key],
                        'no_hp' => $request->no_hp[$key],
                        'biaya_tambahan' => $request->biaya_tambahan[$key],
                        'status' => 1
                    ]);
        }

    }

    public function update_pesanan(Request $request{
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
    }

    // public function create_seat(Request $request){
    // 	$seat = new Seat;
    //     $seat->id_seat = $request->id_seat;
    //     $seat->keterangan = $request->keterangan;
    //     $seat->save();

    //     return "Berhasil";
    // }

}
