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
    	$pesanan = Pesanan::all();
        $jumlah = Pesanan::with('detail_pesanan')->where('id_pesanan', 'id_pesanan')->get();
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

               

        if(!$trip_a->isEmpty() && $seat > $jumlah_penumpang){
            // return response()->json($trip_a);
            return view('erte.pesanan.search', ['trip_a' => $trip_a, 'id_kota_asal' => $id_kota_asal, 'id_kota_tujuan' => $id_kota_tujuan, 'tanggal' => $tanggal, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat]);
            // dd($trip_a->jumlah_penumpang);
        }else{
            session()->flash('flash_danger', 'Tidak ada trip');
            return redirect('/pesanan/create');
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

    public function detail($jumlah_penumpang, $id_trip){
        $trip = Trip::where(['id_trip' => $id_trip])->get();
        $jumlah_penumpang = $jumlah_penumpang;
        // $tes = Trip::select('jadwal')
        //         ->where(['id_kota_asal' => $id_kota_a, 'id_kota_tujuan' => $id_kota_t])
        //         ->whereDate('jadwal', '>', Carbon::now())
        //         ->get();
        $seat = Seat::all();
        return view('erte.pesanan.detail', ['trip' => $trip, 'jumlah_penumpang' => $jumlah_penumpang, 'seat' => $seat]);

    }

	public function store($id_trip, Request $request){
        $this->validate($request, 
            [
            // 'id_users' => 'required',
            'nama_penumpang' => 'required',
            'jenis_kelamin' => 'required',
            'id_seat' => 'required',
            'detail_asal' => 'required',
            'detail_tujuan' => 'required'            
        ]);
        // $trip = Trip::where(['id_trip' => $id_trip])->get();
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
        $pesanan->id_users_pemesan = Auth::guard('operator')->user()->id_users;            
        $pesanan->tanggal_pesan = date('Y-m-d H:i:s');
        $pesanan->id_users_operator = Auth::guard('operator')->user()->id_users;
        $pesanan->save();

        // dd($pesanan->id_pesanan);

        // $pesanan=[];

                // foreach($request->title as $key => $value){
        // array_push(pesanan,[


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

        // Detail_Pesanan::insert($pesanan);
        session()->flash('flash_success', 'Berhasil menambahkan data pesanan ');

        return redirect('/pesanan');
    }

    public function edit($id_pesanan, $id_trip){
    	$pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
        $detail = Detail_Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->get();
        $jumlah = $detail->count();

    	$trip = Trip::all();
    	$pemesan = Pemesan::all();
        $seat = Seat::all();

        // dd(response()->json($detail));

        return view('erte.pesanan.edit', ['pesanan' => $pesanan, 'trip' => $trip, 'pemesan' => $pemesan, 'seat' => $seat, 'detail' => $detail, 'jumlah' => $jumlah]);
    }

    public function update($id_pesanan, $id_trip, Request $request){

            $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
            // $pesanan->id_pesanan = $request->id_pesanan;
            $pesanan->id_trip = $request->id_trip;
            $pesanan->id_users_pemesan = Auth::guard('operator')->user()->id_users;            
            $pesanan->id_users_operator = Auth::guard('operator')->user()->id_users;
            // $pesanan->tanggal_pesan = $request->tanggal_pesan;
            $pesanan->save();

            // $detail =  Detail_Order::where('order_id', $order->id)->get();
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
                    $detail[$i]->biaya_tambahan = $request->biaya_tambahan[$i];
                    $detail[$i]->save();
                }
            }

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

        $feeder = Feeder::where('id_kota', $trip->id_kota_asal)->get();
       // return response()->json($feeder);
        
        return view('erte.pesanan.show', ['trip' => $trip, 'pesanan' => $pesanan, 'detail' => $detail, 'detail_pesanan' => $detail_pesanan, 'feeder' => $feeder]);

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
        // dd($feeder);
        Detail_Pesanan::where('id_pesanan', $id_pesanan)
          ->update(['id_users_feeder' => $feeder]);  

        session()->flash('flash_success', 'Berhasil mengubah data feeder');
        // return redirect('/pesanan');
        // return redirect('/pesanan/show/{id_pesanan}/{id_trip}');
        return redirect('/pesanan/show/'. $id_pesanan .'/' . $id_trip);
        
    }

 	public function delete($id_pesanan, $id_trip){
        $pesanan = Pesanan::where(['id_pesanan' => $id_pesanan, 'id_trip' => $id_trip])->first();
        $pesanan->delete();

        session()->flash('flash_success', "Berhasil menghapus pesanan");
        return redirect('/pesanan');
    	
    }


}
