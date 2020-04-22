@extends('layouts.master')

@section('breadcrumb')
    <section class="content-header">
      <h1>
          Detail Pesanan
      </h1>
    
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/pesanan">Pesanan</a></li>
            <li class="active">Detail</li>
          </ol>

    </section> 
 
 @endsection

 @section('content')     
    <section class="content">
        <div class="box box-solid">
                        <div class="box-header with-border">
                          <i class="fa fa-map-pin"></i>
                          <h3 class="box-title">Pesanan {{ $pesanan->id_pesanan }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <div class="col-sm-6">
                              <dl class="dl-horizontal">
                                <dt>Kota Asal</dt>
                                <dd>
                                      @if($trip->id_kota_asal == "K1")
                                          Bukittinggi
                                      @elseif($trip->id_kota_asal == "K2")
                                          Padang
                                      @elseif($trip->id_kota_asal == "K3")
                                          Payakumbuh
                                      @endif
                                </dd>
                                <dt>Tanggal</dt>
                                <dd>{{ date('d M Y', strtotime($trip->jadwal)) }} </dd>
                                <dt>Pemesan</dt>
                                <dd>{{ $pesanan->pemesan->nama }}</dd>
                              </dl>
                            </div>

                            <div class="col-sm-6">
                              <dl class="dl-horizontal">
                                <dt>Kota Tujuan</dt>
                                <dd>
                                      @if($trip->id_kota_tujuan == "K1")
                                          Bukittinggi
                                      @elseif($trip->id_kota_tujuan == "K2")
                                          Padang
                                      @elseif($trip->id_kota_tujuan == "K3")
                                          Payakumbuh
                                      @endif
                                </dd>
                                <dt>Jam</dt>
                                <dd>{{ date('H:i', strtotime($trip->jadwal)) }}</dd>
                                <dt>Feeder</dt>
                                <dd>
                                        @if(empty($detail_pesanan->feeder->nama))
                                          <a href="/detail_pesanan/edit//{{ $detail_pesanan->id_trip }}/{{ $detail_pesanan->id_seat }}"><u>Tambah Feeder</u></a>
                                        @else
                                          {{ $detail_pesanan->feeder->nama }}
                                        @endif
                                </dd>
                              </dl>
                            </div>
                        </div>

                <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>Seat</th>
                        <th>Penumpang</th>
                        <th>Jenis Kelamin</th>
                        <th>Detail Asal</th>
                        <th>Detail Tujuan</th>
                        <th>Nomor HP</th>
                        <th>Biaya Tambahan</th>
                        <th>Status</th>
                      </tr>
                  </thead>

                  <tbody>
                    @foreach($detail as $d)
                        <tr>
                            <td>{{ $d->detail_seat}}</td>
                            <td>{{ $d->detail_nama }} </td>
                            <td>{{ $d->detail_jk }} </td>
                            <td>{{ $d->detail_asal }} </td>
                            <td>{{ $d->detail_tujuan }} </td>
                            <td>{{ $d->detail_hp }} </td>
                            <td>
                                @if(empty($d->detail_biaya))
                                          <a href="/detail_pesanan/edit//{{ $detail_pesanan->id_trip }}/{{ $detail_pesanan->id_seat }}"><u>Tambah Biaya Tambahan</u></a>
                                @else
                                    {{ $d->detail_biaya }} 
                                @endif
                            </td>
                            <td>
                                @if($d->detail_status == 1)
                                    <span class="badge bg-grey">Booking</span>
                                @elseif($d->detail_status == 2)
                                    <span class="badge bg-light-blue">Picked Up</span>
                                @elseif($d->detail_status == 3)
                                    <span class="badge bg-light-blue">On Going</span>
                                @elseif($d->detail_status == 4)
                                    <span class="badge bg-green">Arrived</span>
                                @elseif($d->detail_status == 5)
                                   <span class="badge bg-red">Cancelled</span>
                                @endif             
                            </td>
                        </tr>
                    @endforeach
      
                  
                </tbody>
              </table>
            </div>

            </div>
        </div>
        



                   
      
                       
                        

                       


        
    </section>

    
@endsection

