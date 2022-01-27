@extends('layouts.master')

@section('breadcrumb')
    <section class="content-header">
      <h1>
          Detail Data Mobil
      </h1>
    
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/mobil">Mobil</a></li>
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
                        <!-- <a href="/mobil/edit/{{ $plat_mobil }}" class="btn btn-md" ><i class="fa fa-edit"></i> Edit</a> -->
                        <!-- <a class="btn btn-md" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/mobil/delete/{{ $plat_mobil }}"><i class="fa fa-trash"></i> Hapus Mobil</a> -->
                        <a href="/mobil/" class="btn btn-md" ><i class="fa fa-list"></i> List Mobil</a>
                        <a href="/mobil/create/" class="btn btn-md" ><i class="fa  fa-plus-circle"></i> Tambah Mobil</a>                       
                    </div>
                        </br>
                        </br>

                    <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <b>Anda yakin ingin menghapus data Mobil ini ?</b><br><br>
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
                          <h3 class="box-title">Mobil {{ $plat_mobil }}    
                        </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <!-- <div class="col-sm-4"> -->
                              <dl class="dl-horizontal">
                                <dt>Sopir</dt>
                                <dd>{{ $sopir }} </dd>
                                <dt>Merek Mobil</dt>
                                <dd>{{ $mobil->merek_mobil }}</dd>
                              </dl>
                            <!-- </div> -->

                            <!-- <div class="col-sm-4"> -->
                              <dl class="dl-horizontal">
                                <!-- <dt>Merek Mobil</dt>
                                <dd>{{ $mobil->merek_mobil }}</dd> -->
                              </dl>
                            <!-- </div> -->
                        </div>

                <div class="box-body">
                <table class="table table-bordered table-hover table-striped" id="sortdata">
                  <thead>
                      <tr>
                        <th>Seat</th>
                        <th>Keterangan</th>
                        <!-- <th>Detail Asal</th>
                        <th>Detail Tujuan</th>
                        <th>OPSI</th> -->
                      </tr>
                  </thead>

                  <tbody>
                    @foreach($seat as $d)
                      <tr>
                        <td>{{ $d->id_seat}}</td>
                        <td>{{ $d->keterangan}}</a></td>
                        <!-- <td>{{ $d->detail_asal}}</td>
                        <td>{{ $d->detail_tujuan}}</td>
                        <td><a href="/pesanan/show/{{ $d->id_pemesan }}/{{ $d->jadwal}}/{{ $d->plat_mobil }}" class="btn btn-lg"><i class="fa fa-eye"></i></a></td> -->
                        
                      </tr>
                    @endforeach
                      
      
                  
                </tbody>
              </table>
            </div>

            </div>
        </div>
    </section>

    
@endsection