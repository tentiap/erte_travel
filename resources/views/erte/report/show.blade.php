
@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Rekap Trip 
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/report">Report</a></li>
            <li class="active">Show</li>
          </ol>
  </section>
 @endsection

@section('content') 
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
            <i class="fa fa-map-pin"></i>
                <h3 class="box-title">
                  Trip pada tanggal {{ date('d-M-Y', strtotime($startDate)) }} sampai {{ date('d-M-Y', strtotime($end)) }} 
                </h3>
        </div>
        <div class="box-body">
          <!-- <div class="box"> -->
              @include('messages')

            <div class="box-body">
                <table class="table table-bordered table-hover table-striped" id="tableTrip">
                  <thead>
                      <tr>
                        <!-- <th class="hidden">Class Hidden</th> -->
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Plat Mobil</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Sopir</th>
                        <th class="hidden">Jumlah Penumpang</th>
                      </tr>
                </thead>
                <tbody>
                  @php
                    $i = 0
                  @endphp

                  @foreach($trip as $t)
                        <tr>
                            @php
                              $i = $i + 1
                            @endphp
                            <!-- <td class="hidden" id="idTrip" name="id_trip">{{$t->id_trip}}</td> -->
                            <td>{{ $i }}</td>
                            <td>{{ date('d-M-Y', strtotime($t->jadwal)) }} </td>
                            <td>{{ date('H:i', strtotime($t->jadwal)) }} </td>
                            <td>{{ $t->plat_mobil }}</td>
                            <td>
                                  
                                      @if($t->id_kota_asal == "K1")
                                          Bukittinggi
                                      @elseif($t->id_kota_asal == "K2")
                                          Padang
                                      @elseif($t->id_kota_asal == "K3")
                                          Pekanbaru
                                      @endif
                                  
                            </td>        
                            <td>
                                      @if($t->id_kota_tujuan == "K1")
                                          Bukittinggi
                                      @elseif($t->id_kota_tujuan == "K2")
                                          Padang
                                      @elseif($t->id_kota_tujuan == "K3")
                                          Pekanbaru
                                      @endif
                            </td>
                            <td id="jumlahPenumpang" class="hidden">
                                  

                            </td>
                            <td>
                                    @if(empty($t->mobil->sopir->nama))
                                      Belum ada sopir
                                    @else
                                      {{ $t->mobil->sopir->nama }}
                                    @endif
                            </td>

                        </tr>

                  @endforeach

                  <script type="text/javascript">
                    window.print();
                  </script>
                </tbody>
              </table>
            </div>

        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection