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
            <li class="active">Detail Trip</li>
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
                    @endforeach                    
                </div>

            </div>

            
                    
                    <form method="post" action="">
                        @for ($i = 0; $i < $jumlah_penumpang; $i++)

                                {{ csrf_field() }}

                            <div class="box box-default collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Detail Penumpang {{$i + 1}}</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                        <div class="form-group">
                                            <label>ID</label>
                                            <input type="text" name="id_seat" class="form-control" placeholder="ID seat" value="">  

                                            @if($errors->has('id_seat'))
                                                <div class="text-danger">
                                                    {{ $errors->first('id_seat')}}
                                                </div>
                                            @endif                         
                                        </div>
                                  </div>
                                <!-- <div class="box-body"> -->
                            </div>
                        <!-- /.box -->
                        @endfor                        

                                <div class="form-group">
                                    <input type="submit" class="btn btn-info" value="Simpan">
                                    <button class="btn btn-default btn-close"><a href="/seat">Cancel</a></button>
                                </div>
                    </form>
                        
                </div>
        <!-- Jangan -->                                               
            </div> 

        </div>
           
            

        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection