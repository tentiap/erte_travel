@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Detail Pesanan
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/pesanan">Pesanan</a></li>
            <li><a href="/detail_pesanan">Detail Pesanan</a></li>
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
                <a href="/detail_pesanan/create" class="btn btn-primary">Tambah Detail Pesanan</a>
              </div>

              

            <div class="box-body">
                <table id="sortdata" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>ID Trip</th>
                        <th>ID Users Pemesan</th>
                        <th>ID Seat</th>
                        <th>Nama Penumpang</th>
                        <th>Jenis Kelamin</th>
                        <th>Detail Asal</th>
                        <th>Detail Tujuan</th>
                        <th>Biaya Tambahan</th>
                        <th>Status</th>
                        <th>Nomor HP</th>              
                        <th>OPSI</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach($detail_pesanan as $d)
                      
                            <tr>
                                <td>{{ $d->id_trip }}</td>
                                <td>{{ $d->id_users_pemesan}}</td>
                                <td>{{ $d->id_seat}}</td>
                                <td>{{ $d->nama_penumpang }}</td>
                                <td>{{ $d->jenis_kelamin }}</td>
                                <td>{{ $d->detail_asal }}</td>
                                <td>{{ $d->detail_tujuan }}</td>
                                <td>{{ $d->biaya_tambahan }}</td>
                                <td>{{ $d->status }}</td>
                                <td>{{ $d->no_hp }}</td>                         
                                
                                <td>
                                    <a href="/detail_pesanan/show/{{ $d->id_trip, $d->id_users_pemesan, $d->id_seat }}" class="btn btn-lg"><i class="fa fa-eye"></i></a>
                                    <a href="/detail_pesanan/edit/{{ $d->id_trip}}/{{$d->id_users_pemesan}}/{{$d->id_seat}}" class="btn btn-lg"><i class="fa fa-edit"></i></a>

                                    <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/detail_pesanan/delete/{{ $d->id_trip}}/{{$d->id_users_pemesan}}/{{$d->id_seat}}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>


                                    <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <b>Anda yakin ingin menghapus detail pesanan ini ?</b><br><br>
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

        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection