@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Data Mobil
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../mobil">Mobil</a></li>
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
                <a href="/mobil/create" class="btn btn-primary">Tambah Mobil</a>
              </div>

              

            <div class="box-body">
                <table class="table table-bordered table-hover table-striped" id="sortdata">
                  <thead>
                      <tr>
                        <th>Plat Mobil</th>
                        <th>Sopir</th>
                        <th>Merek Mobil</th>
                        <th>OPSI</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach($mobil as $m)
                    <tr>
                        <td>{{ $m->plat_mobil }}</td>
                        <td>{{ $m->sopir->nama }}</td>
                        <td>{{ $m->merek_mobil }}</td>
                        <td>
                            <a href="/mobil/edit/{{ $m->plat_mobil }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                            <a href="/mobil/show/{{ $m->plat_mobil }}" class="btn btn-lg"><i class="fa fa-eye"></i></a>
                            <!-- <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/mobil/delete/{{ $m->plat_mobil }}"><i class="fa fa-trash"></i></a> -->
                        </td>
                    </tr>

                    <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <b>Anda yakin ingin menghapus data mobil ini ?</b><br><br>
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

            {{ $mobil->links() }}

        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection