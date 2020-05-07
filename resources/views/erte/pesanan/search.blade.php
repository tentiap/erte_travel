@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Pesanan
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/pesanan">Pesanan</a></li>
            <li><a href="/pesanan/create">Create</a></li>
            <li class="active">List Trip</li>
          </ol>
  </section>
 @endsection

@section('content') 
    <section class="content">
      <div class="box">
        <div class="box-body">
          <!-- <div class="box"> -->
              @include('messages')

            <div class="">
                <div class="box box-info box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title">Pilih Trip</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        @if($id_kota_asal == "K1")
                                Bukittinggi
                        @elseif($id_kota_asal == "K2")
                                          Padang
                        @elseif($id_kota_asal == "K3")
                                          Payakumbuh
                        @endif

                        -  

                        @if($id_kota_tujuan == "K1")
                                Bukittinggi
                        @elseif($id_kota_tujuan == "K2")
                                Padang
                        @elseif($id_kota_tujuan == "K3")
                                Payakumbuh
                        @endif

                        
                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{ date('D, d M Y', strtotime($tanggal)) }}

                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{$jumlah_penumpang}} penumpang

                        
                        <a href="/pesanan/create" style="position: absolute; top: 50px;right: 16px;"><i class="fa fa-edit"></i> Ubah Pencarian</a>

                  </div>
                      
                </div>
                <!-- /.box -->
          </div>  
           
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Jam</th>
                        <th>Sopir</th>
                        <th>Keterangan</th>
                        <th>#</th>
                      </tr>
                  </thead>
                <tbody>
                  @foreach($trip_a as $t)
                    <tr>
                      <td>{{$t->id_trip}}</td>
                      <td>{{ date('H:i', strtotime($t->jadwal)) }}</td>
                      <td>
                              @if(empty($t->id_users_sopir))
                                  Belum Ada Sopir
                              @else
                                  {{ $t->sopir->nama }}
                              @endif
                      </td>
                      <td>Sekian Trip Tersedia</td>
                      <td>
                        <a href="/pesanan/store/{{$t}}"><button type="button" class="btn btn-info">Pesan</button></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection