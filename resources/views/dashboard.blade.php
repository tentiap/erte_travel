@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Dashboard<small>Welcome, {{ Auth::guard('operator')->user()->nama }} ({{ Auth::guard('operator')->user()->kota->nama_kota }})</small>
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
  </section>
 @endsection

 @section('content')

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$pemesan}}</h3>

              <p>Pemesan</p>
            </div>
            <a href="/pemesan" class="small-box-footer">List Pemesan <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$sopir}}</h3>

              <p>Sopir</p>
            </div>
            <a href="/sopir" class="small-box-footer">List Sopir <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$feeder}}</h3>

              <p>Feeder</p>
            </div>
            <!-- <div class="icon">
              <i class="ion ion-person-add"></i>
            </div> -->
            <a href="/feeder" class="small-box-footer">List Feeder <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$pesanan}}</h3>

              <p>Pesanan</p>
            </div>
            
            <a href="/pesanan" class="small-box-footer">List Pesanan <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Trip Hari Ini <small>({{ date('d M Y', strtotime($today)) }})</small></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="sortdata" class="table table-bordered table-hover table-striped">
                  <thead>
                  <tr>
                    <th>ID Trip</th>
                    <th>Jam</th>
                    <th>Kota Asal</th>
                    <th>Kota Tujuan</th>
                    <th>Sopir</th>
                    <th>Ketersediaan</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($trip as $t)
                      
                            <tr>
                                <td><a href="/trip/show/{{ $t->id_trip }}"><u>{{ $t->id_trip }}</u></a></td>
                                <td>{{ date('H:i', strtotime($t->jadwal)) }} </td>
                                <td>
                                  
                                      @if($t->id_kota_asal == "K1")
                                          Bukittinggi
                                      @elseif($t->id_kota_asal == "K2")
                                          Padang
                                      @elseif($t->id_kota_asal == "K3")
                                          Payakumbuh
                                      @endif
                                  
                                </td>        
                                <td>
                                      @if($t->id_kota_tujuan == "K1")
                                          Bukittinggi
                                      @elseif($t->id_kota_tujuan == "K2")
                                          Padang
                                      @elseif($t->id_kota_tujuan == "K3")
                                          Payakumbuh
                                      @endif
                                </td>
                                <td>
                                      @if(empty($t->id_users_sopir))
                                        <a href="/trip/edit/{{ $t->id_trip }}"><u>Tambah Sopir</u></a>
                                      @else
                                        {{ $t->sopir->nama }}
                                      @endif
                                </td>
                                <td></td>  
                    @endforeach             
                  
                  </tbody>
                </table>
              </div>
              
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
          </div>
     
    </section>
    <!-- /.content -->

 @endsection