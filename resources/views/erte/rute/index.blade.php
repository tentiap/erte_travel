@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Data Rute
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../rute">Rute</a></li>
            <li class="active">Index</li>
          </ol>
  </section>
 @endsection

@section('content') 
    <section class="content">
      <div class="box">
        <div class="box-body">
          <!-- <div class="box"> -->
              @include('messages')
              <div class="box-header" align="right">
                <!-- <a href="/rute/export" class="btn btn-sm btn-primary">Export Excel</a> -->
                <a href="/rute/create" class="btn btn-sm btn-primary">Tambah Rute</a>
              </div>

              <!-- <div class="box-header" align="right">
                
              </div> -->

            <div class="box-body">
                <table id="sortdata" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>Kota Asal</th>
                        <th>Kota Tujuan</th>
                        <th>Tarif</th>
                        <th>Last Updated</th>
                        <th>Opsi</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach($rute as $r)
                            <tr>
                                <td>{{ $r->kota_asal->nama_kota }}</td>
                                <td>{{ $r->kota_tujuan->nama_kota }}</td>
                                <td>@currency($r->tarif)</td>
                                <td>{{ $r->updated_at }}</td>
                                <td>
                                    
                                    <a href="/rute/edit/{{ $r->id_kota_asal }}/{{ $r->id_kota_tujuan }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/rute/delete/{{ $r->id_kota_asal }}/{{ $r->id_kota_tujuan }}"><i class="fa fa-trash"></i></a>
                                    
                                </td>
                            </tr>

                            <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <b>Anda yakin ingin menghapus data rute ini ?</b><br><br>
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

                  @endforeach
                </tbody>
              </table>
            </div>

          <!-- </div> -->
        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection