@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Penumpang di Pesanan {{$pesanan->id_pesanan}}<small>(Trip {{$pesanan->id_trip}} )</small> 
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/pesanan">Pesanan</a></li>
            <li class="active">Tambah Detail Penumpang</li>
          </ol>
  </section>
 @endsection

@section('content') 
    <section class="content">
      <div class="box">
        <div class="box-body">
          <!-- <div class="box"> -->
              @include('messages')

            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Trip</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                  <!-- /.box-header -->
                <div class="box-body">
                    @foreach($trip as $t)
                        @if($t->id_kota_asal == "K1")
                                Bukittinggi
                        @elseif($t->id_kota_asal == "K2")
                                          Padang
                        @elseif($t->id_kota_asal == "K3")
                                          Payakumbuh
                        @endif

                        -  

                        @if($t->id_kota_tujuan == "K1")
                                Bukittinggi
                        @elseif($t->id_kota_tujuan == "K2")
                                Padang
                        @elseif($t->id_kota_tujuan == "K3")
                                Payakumbuh
                        @endif

                        
                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{ date('D, d M Y', strtotime($t->jadwal)) }}

                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{ date('H:i', strtotime($t->jadwal)) }}

                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{$jumlah_penumpang}} penumpang

                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                            @foreach($pemesan as $p)
                              {{$p->nama}}
                            @endforeach


                        <!-- <a href="/pesanan/create" style="position: absolute; top: 50px;right: 16px;"><i class="fa fa-edit"></i> Ubah Pencarian</a>
 -->

                    @endforeach  

                </div>

            </div>

                
                        
                </div>
        <!-- Jangan -->                                               
            </div> 

            
           
        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection