<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Trip;
use PDF;

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
        $endDate = Input::get('endDate');
        $filter = '%'.$startDate.'%';

        if (empty($startDate) || empty($endDate) ){
            session()->flash('flash_danger', 'Select Date First!');
            return redirect('/report');
        }elseif ($startDate > $endDate){
            session()->flash('flash_danger', 'Invalid Date');
            return redirect('/report');
        }elseif ($startDate == $endDate) {
            $trip = Trip::where('jadwal', 'like', $filter)
                    ->orderBy('jadwal', 'asc')
                    ->get();

            return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate]);

                // if (!empty($trip)) {
                //    return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate]); 
                // }else{
                //     session()->flash('flash_danger', 'Tidak ada data trip');
                //     return redirect('/report'); 
                // }
        }else{
            $trip = Trip::whereBetween('jadwal', [$startDate, $endDate])
                    ->orderBy('jadwal', 'asc')
                    ->get();

                // if (empty($trip)) {
                //     session()->flash('flash_danger', 'Tidak ada data trip');
                //     return redirect('/report');
                // }    
                    
            return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate]);
            // $pdf = PDF::loadview('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate])->setPaper("A4", "portrait");
            // $pdf = PDF::loadview('erte.report.dashboard')->setPaper("A4", "portrait");
            // return $pdf->stream();
        }

        // $trip = Trip::whereBetween('jadwal', [$startDate, $endDate])
        //             ->orderBy('jadwal', 'asc')
        //             ->get();

        // $trip = Trip::where('jadwal', '>=', $startDate)
        //             ->where('jadwal', '<=', $endDate)
        //             ->orderBy('jadwal', 'asc')
        //             ->get();

        

        
        
    }
}
