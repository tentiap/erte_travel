@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Permissions
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../permissions">Permissions</a></li>
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
                <a href="/permissions/create" class="btn btn-primary">Tambah Permissions</a>
              </div>

     <div class="box-body">
            <table id="sortdata" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Permissions</th>
                        <th>OPSI</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($permissions as $p)
                    <tr>

                        <td>{{ $p->name }}</td>

                        <td>

                        <a href="/permissions/edit/{{ $p->id }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>

                        <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/permissions/delete/{{ $p->id }}"><i class="fa fa-trash"></i></a>         
                        </td>
                    </tr>

                                                 <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <b>Anda yakin ingin menghapus data permission ini ?</b><br><br>
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
</div>
</section>

@endsection