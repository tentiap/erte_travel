<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\Trip;
use App\Pemesan;
use App\Operator;
use App\Detail_Pesanan;

class PesananController extends Controller
{
    public function index(){
    	$pesanan = Pesanan::all();
        // $pesanan = Pesanan::with("detail_pesanan")->where("id_pesanan", 1)->get();
        // $pesanan = Pesanan::join('detail_pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
        //             ->select('pesanan.id_trip as pesanan_trip',
        //                      'detail_pesanan.id_seat as detail_seat',
        //                      'detail_pesanan.nama_penumpang as detail_nama')->get();
    	$trip = Trip::all();
    	$pemesan = Pemesan::all();
        $operator = Operator::all();

        // dd($pesanan);


        return view('erte.pesanan.index', ['pesanan' => $pesanan, 'trip' => $trip,  'pemesan' => $pemesan, 'operator' => $operator]);
    }

    public function create(){
    	$pesanan = Pesanan::all();
    	$trip = Trip::all();
    	$pemesan = Pemesan::all();
    	
     	return view('erte.pesanan.create', ['pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan]);
	}

	public function store(Request $request){
    	$this->validate($request, 
            [
            // 'id_pesanan' => 'required',    
    		'id_trip' => 'required',
    		'id_users_pemesan' => 'required'
    		// 'tanggal_pesan' => 'required'
        ]);

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
        $pesanan->id_trip = $request->id_trip;
        $pesanan->id_users_pemesan = $request->id_users_pemesan;            
        $pesanan->tanggal_pesan = date('YYYY-MM-DD HH:mm');
        $pesanan->id_users_operator = Auth::guard('operator')->user()->id_users;
        $pesanan->save();

    	// Pesanan::create([
     //        'id_pesanan' => $request->id_pesanan,
    	// 	'id_trip' => $request->id_trip,
     //        'id_users_pemesan' => $request->id_users_pemesan,
     //        'tanggal_pesan' => date('YYYY-MM-DD HH:mm')
    	// ]);

        session()->flash('flash_success', 'Berhasil menambahkan data pesanan ');

    	return redirect('/pesanan');
    }

    public function edit($id_pesanan, $id_trip){
    	$pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();

    	$trip = Trip::all();
    	$pemesan = Pemesan::all();

        return view('erte.pesanan.edit', ['pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan]);
    }

    public function update($id_pesanan, $id_trip, Request $request){
    	 $this->validate($request, [
            // 'id_pesanan' => 'required',
            'id_trip' => 'required',
            'id_users_pemesan' => 'required',
            // 'tanggal_pesan' => 'required'
        ]);

            $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();

            // $pesanan->id_pesanan = $request->id_pesanan;
            $pesanan->id_trip = $request->id_trip;
            $pesanan->id_users_pemesan = $request->id_users_pemesan;
            // $pesanan->tanggal_pesan = $request->tanggal_pesan;
            $pesanan->save();

            session()->flash('flash_success', 'Berhasil mengupdate data pesanan');
         return redirect('/pesanan');
    }

     public function show($id_pesanan, $id_trip){

        $trip = Trip::find($id_trip);
        $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();   
        $detail_pesanan = Detail_Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();   
        $detail = Pesanan::join('detail_pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
                    ->where('pesanan.id_pesanan', $id_pesanan)
                    ->select('pesanan.id_trip as pesanan_trip',
                             'pesanan.id_pesanan as pesanan_id',
                             'pesanan.id_users_pemesan as pesanan_pemesan',
                             'pesanan.tanggal_pesan as pesanan_tanggal',
                             'detail_pesanan.id_seat as detail_seat',
                             'detail_pesanan.nama_penumpang as detail_nama',
                             'detail_pesanan.jenis_kelamin as detail_jk',
                             'detail_pesanan.detail_asal as detail_asal',
                             'detail_pesanan.detail_tujuan as detail_tujuan',
                             'detail_pesanan.no_hp as detail_hp',
                             'detail_pesanan.status as detail_status',
                             'detail_pesanan.biaya_tambahan as detail_biaya')
                    ->get();
        
        return view('erte.pesanan.show', ['trip' => $trip, 'pesanan' => $pesanan, 'detail' => $detail, 'detail_pesanan' => $detail_pesanan]);

    }

 	public function delete($id_pesanan, $id_trip){
        $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
        $pesanan->delete();

        session()->flash('flash_success', "Berhasil menghapus pesanan");
        return redirect('/pesanan');
    	
    }


}
