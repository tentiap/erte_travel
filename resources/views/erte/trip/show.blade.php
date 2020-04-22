@extends('layouts.master')

@section('breadcrumb')
    <section class="content-header">
      <h1>
          Detail Data Trip
      </h1>
    
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/trip">Trip</a></li>
            <li class="active">Detail</li>
          </ol>

    </section>
          
 
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                <!-- <style>
                    .outset {border-style: outset;}
                </style> -->
                    <div style="position: absolute; right: 0;">
                        <a href="/trip/edit/{{ $trip->id_trip }}" class="btn btn-md" ><i class="fa fa-edit"></i> Edit</a>
                        <a class="btn btn-md" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/trip/delete/{{ $trip->id_trip }}"><i class="fa fa-trash"></i> Hapus Trip</a>
                        <a href="/trip/" class="btn btn-md" ><i class="fa fa-list"></i> List Trip</a>
                        <a href="/trip/create/" class="btn btn-md" ><i class="fa  fa-plus-circle"></i> Tambah Trip</a>                       
                    </div>
                        </br>
                        </br>

                    <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <b>Anda yakin ingin menghapus data Trip ini ?</b><br><br>
                                    <a class="btn btn-danger btn-ok"> Hapus</a>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                        <script type="text/javascript">
                            //Hapus Data
                            $(document).ready(function() {
                                $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
                                    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                                });
                            });
                    </script>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                          <i class="fa fa-map-pin"></i>
                          <h3 class="box-title">Trip {{ $trip->id_trip }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <div class="col-sm-6">
                              <dl class="dl-horizontal">
                                <dt>Tanggal</dt>
                                <dd>{{ date('d M Y', strtotime($trip->jadwal)) }} </dd>
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
                                <dt>Sopir</dt>
                                <dd>
                                    @if(empty($trip->id_users_sopir))
                                      <a href="/trip/edit/{{ $trip->id_trip }}"><u>Tambah Sopir</u></a>
                                    @else
                                      {{ $trip->sopir->nama }}
                                    @endif
                                </dd>
                              </dl>
                            </div>

                            <div class="col-sm-6">
                              <dl class="dl-horizontal">
                                <dt>Jam</dt>
                                <dd>{{ date('H:i', strtotime($trip->jadwal)) }}</dd>
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
                                <dt>Operator</dt>
                                <dd>{{ $trip->operator->nama }}</dd>
                              </dl>
                            </div>
                        </div>

                <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>Seat</th>
                        <th>Penumpang</th>
                        <th>Detail Asal</th>
                        <th>Detail Tujuan</th>
                        <th>OPSI</th>
                      </tr>
                  </thead>

                  <tbody>
                    
      
                  
                </tbody>
              </table>
            </div>

            </div>
        </div>
    </section>

    
@endsection