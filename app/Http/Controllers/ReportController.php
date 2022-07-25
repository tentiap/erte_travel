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
        return view('erte.report.index');
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

            if (Auth::guard('pengurus')->user()->id_pengurus == 'admin') {
                $trip = Trip::join('mobil','trip.plat_mobil', '=', 'mobil.plat_mobil')
                ->join('sopir', 'mobil.id_sopir', '=', 'sopir.id_sopir')
                ->where('jadwal', 'like', $filter)
                ->orderBy('jadwal', 'asc')
                ->get();

                return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate, 'end' => $end]);
            }else{
                $kota = Auth::guard('pengurus')->user()->id_kota;
                $trip = Trip::where('jadwal', 'like', $filter)
                        ->where('id_kota_asal', $kota)
                        ->orderBy('jadwal', 'asc')
                        ->get();

                return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate, 'end' => $end]);
            }

        }else{

            if (Auth::guard('pengurus')->user()->id_pengurus == 'admin') {
                $trip = Trip::whereBetween('jadwal', [$startDate, $endDate])
                    ->orderBy('jadwal', 'asc')
                    ->get();

                return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate, 'end' => $end]);
            }else{
                $kota = Auth::guard('pengurus')->user()->id_kota;
                $trip = Trip::whereBetween('jadwal', [$startDate, $endDate])
                    ->where('id_kota_asal', $kota)
                    ->orderBy('jadwal', 'asc')
                    ->get();
                    
                return view('erte.report.show', ['trip' => $trip, 'startDate' => $startDate, 'endDate' => $endDate, 'end' => $end]);    
            }
        }
    }
}
