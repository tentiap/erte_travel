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
          @include('messages')

                    <div style="position: absolute; right: 0;">
                        <a href="/pesanan/edit/{{ $pesanan->id_pemesan}}/{{ $pesanan->jadwal}}/{{ $pesanan->plat_mobil}}" class="btn btn-md" ><i class="fa fa-edit"></i> Edit</a>
                        <a class="btn btn-md" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/pesanan/delete/{{ $pesanan->id_pemesan}}/{{ $pesanan->jadwal}}/{{ $pesanan->plat_mobil}}"><i class="fa fa-trash"></i> Hapus Pesanan</a>
                        <a href="/pesanan/" class="btn btn-md" ><i class="fa fa-list"></i> List Pesanan</a>
                        <a href="/pesanan/create/" class="btn btn-md" ><i class="fa  fa-plus-circle"></i> Tambah Pesanan Baru</a>
                        <a class="btn btn-md" data-toggle='modal' data-target='#update_penumpang' data-href=""><i class="fa  fa-plus-circle"></i>Tambah Penumpang</a>
                    </div>
                        </br>
                        </br>

                    <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <b>Anda yakin ingin menghapus data pesanan ini ?</b><br><br>
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

                        <div class="box-header with-border">
                          <!-- <i class="fa fa-map-pin"></i> -->
                          <h3 class="box-title">Pesanan {{ $id }} </h3>
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
                                          Pekanbaru
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
                                          Pekanbaru
                                      @endif
                                </dd>
                                <dt>Jam</dt>
                                <dd>{{ date('H:i', strtotime($trip->jadwal)) }}</dd>
                                <!-- <dt>Feeder</dt> -->
                                <dd>
                                        
                                </dd>
                              </dl>
                            </div>
                        </div>

                        

                    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                        <script type="text/javascript">
                            //Hapus Data
                            $(document).ready(function() {
                                // $( "#update_feeder" ).change(function() {
                                //    var id_users_feeder = $( "#feeder option:selected" ).val();
                                //    // console.log(id_users_feeder);                       
                                //    });
                                $('#update_feeder').on('show.bs.modal', function(e) {
                                    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                                });
                            });
                    </script>
 -->
                    <!-- <script>
                       $( "#update_feeder" ).change(function() {
                       var id_users_feeder = $( "#feeder option:selected" ).val();
                       console.log(id_users_feeder);                       
                       });
                    </script> -->




                <div class="box-body">
                <table class="table table-bordered table-hover table-striped" id="sortdata">
                  <thead>
                      <tr>
                        <th>Nama Penumpang</th>
                        <th>Jenis Kelamin</th>
                        <th>Nomor HP</th>
                        <th>Detail Asal</th>
                        <th>Detail Tujuan</th>
                        <th>Seat</th>
                        <th>Order Number</th>
                        <th>Biaya Tambahan</th>
                        <th>Feeder</th>
                        <th>Status</th>
                      </tr>
                  </thead>

                  <tbody>
                    @foreach($detail as $d)
                        <tr>
                            <td>{{ $d->nama_penumpang }} </td>
                            <td>{{ $d->jenis_kelamin }} </td>
                            <td>
                                  @if(empty($d->no_hp))
                                            -
                                  @else
                                      {{ $d->no_hp }} 
                                  @endif    
                            </td>
                            <td>{{ $d->detail_asal }} </td>
                            <td>{{ $d->detail_tujuan }} </td>
                            <td>{{ $d->id_seat}}</td>
                            <td>{{ $d->order_number}}</td>
                            <td>
                                  @if(empty($d->biaya_tambahan))
                                             -
                                  @else
                                      @currency($d->biaya_tambahan)
                                  @endif                                
                            </td>
                            <td>
                                  @if(empty($d->feeder->nama))
                                      Belum ada Feeder
                                  @else
                                      {{ $d->feeder->nama }}
                                  @endif
                            </td>
                            <td>
                                @if($d->status == 1)
                                    <span class="badge bg-grey">Booking</span>
                                @elseif($d->status == 2)
                                    <span class="badge bg-lime">Picked Up</span>
                                @elseif($d->status == 3)
                                    <span class="badge bg-light-blue">On Going</span>
                                @elseif($d->status == 4)
                                    <span class="badge bg-green">Arrived</span>
                                @elseif($d->status == 5)
                                   <span class="badge bg-red">Cancelled</span>
                                @endif             
                            </td>
                        </tr>
                    @endforeach      
                  
                </tbody>
              </table>

                <div class="row no-print">
                    <div class="col-xs-12">
                        @if($jumlah > 0)
                            <a href="/pesanan/print/{{ $pesanan->id_pemesan}}/{{ $pesanan->jadwal}}/{{ $pesanan->plat_mobil}}" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
                        @endif
                    </div>
                </div>              
            </div>


                         <div class="modal fade" id="update_penumpang" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="form-group">
                                      <form method="get" action="/pesanan/update_create/{{$pesanan->id_pemesan}}/{{$pesanan->jadwal}}/{{$pesanan->plat_mobil}}">
                                        <label>Trip {{$trip->jadwal}}-{{$trip->plat_mobil}}</label>
                                            
                                                @if($seat_tersedia == 0)
                                                    <p>Trip sudah penuh !</p>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"> Batal</button>          
                                                @else
                                                    <p>{{$seat_tersedia}} seat tersedia</p>
                                                    <input type="submit" class="btn btn-primary" value="Tambah">                           
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"> Batal</button>          
                                                @endif    
                                              
    
                                        
                                      
                                        
                                     </form>
                                  </div>    
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>
        </div>
       
    </section>

    
@endsection

