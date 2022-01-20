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




                   
      
                        <div class="form-group">
                            <label>ID Trip</label>
                            <input type="text" name="id_trip" class="form-control"  value="{{$trip->id_trip}}" readonly>

                        </div>

                        <div class="form-group">
                            <label>Tanggal</label>

                            <input type="text" name="tanggal" class="form-control" value="{{$trip->tanggal}}" readonly>                                                  
                        </div>

                        <div class="form-group">
                            <label>Jam</label>
                            <input type="text" name="jam" class="form-control"  value="{{$trip->jam}}" readonly>

                             
                        </div>

                        

                        <div class="form-group">
                            <label>Rute</label>
                            <input type="text" name="rute" class="form-control"  value="{{$trip->rute->kota_asal->nama_kota}} - {{$trip->rute->kota_tujuan->nama_kota}}" readonly>

                             
                        </div>

                        <div class="form-group">
                            <label>Sopir</label>
                            <input type="text" name="sopir" class="form-control"  value="{{$trip->sopir->users->nama}}" readonly>

                             
                        </div>

                        <div class="form-group">
                            <label>Feeder</label>
                            <input type="text" name="feeder" class="form-control"  value="{{$trip->feeder->users->nama}}" readonly>

                             
                        </div>

                        <div class="form-group">
                            <label>Pengurus</label>
                            <input type="text" name="pengurus" class="form-control"  value="{{$trip->pengurus->users->nama}}" readonly>

                             
                        </div>
            </div>
        </div>
    </section>

    
@endsection