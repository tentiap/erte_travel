<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Trip;
use PDF;
use Auth;

class ReportController extends Controller
{
    public function index(Request $request){

        // $trip = Trip::whereBetween('jadwal', ['2021-07-13 00:00:55', '2021-08-01 10:15:5'])
        //             ->orderBy('jadwal', 'asc')
        //             ->get();

                    // dd($trip);

        // $trip = Trip::join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
        //             ->whereBetween('jadwal', ['2021-07-13 00:00:55', '2021-08-01 10:15:5'])
        //             ->where('detail_pesanan.status', '!=', 5)
        //             ->select('detail_pesanan.id_pesanan','detail_pesanan.id_seat')
        //             ->count(); 
        // return view('erte.report.index', ['trip' => $trip]);

        // $seat = Trip::join('detail_pesanan', 'trip.id_trip', '=', 'detail_pesanan.id_trip')
        //             ->whereBetween('jadwal', ['2021-07-13 00:00:55', '2021-08-01 10:15:5'])
        //             ->where('detail_pesanan.status', '!=', 5)
        //             ->select('detail_pesanan.id_pesanan','detail_pesanan.id_seat')
        //             ->count(); 

        // dd($seat);

        // $pdf = \PDF::loadView('erte.report.index', $trip);
        return view('erte.report.index');
        // return $pdf->download('report.pdf');
        
    }

    public function show(){

        $startDate = Input::get('startDate');
        $end = Input::get('endDate');
        $endDate = date('Y-m-d', strtotime($end. ' + 1 days'));
        $filter = '%'.$startDate.'%';

        if (empty($startDate) || empty($endDate) ){
            session()->flash('flash_danger', 'Select Date First!');
            return redirect('/report');
        }elseif ($startDate > $endDate){
            session()->flash('flash_danger', 'Invalid Date');
            return redirect('/report');
        }elseif ($startDate == $endDate) {

            if (Auth::guard('operator')->user()->id_users == 'admin') {
                $trip = Trip::where('jadwal', 'like', $filter)
                        ->orderBy('jadwal', 'asc')
                        ->get();

                return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate, 'end' => $end]);
            }else{
                $kota = Auth::guard('operator')->user()->id_kota;
                $trip = Trip::where('jadwal', 'like', $filter)
                        ->where('id_kota_asal', $kota)
                        ->orderBy('jadwal', 'asc')
                        ->get();

                return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate, 'end' => $end]);
                
            }

        }else{

            if (Auth::guard('operator')->user()->id_users == 'admin') {
                $trip = Trip::whereBetween('jadwal', [$startDate, $endDate])
                    ->orderBy('jadwal', 'asc')
                    ->get();
                    
                return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate, 'end' => $end]);
            }else{
                $kota = Auth::guard('operator')->user()->id_kota;
                $trip = Trip::whereBetween('jadwal', [$startDate, $endDate])
                    ->where('id_kota_asal', $kota)
                    ->orderBy('jadwal', 'asc')
                    ->get();
                    
                return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate, 'end' => $end]);
                
            }
        }
        
    }
}
