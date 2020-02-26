@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Data Users
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../users">Users</a></li>
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
                <!-- <a href="/users/create" class="btn btn-primary">Tambah Users</a> -->
                <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-toggle="dropdown">Tambah Users</button>
                        <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tambah Users</button> -->
                         <!--  <span class="caret"></span> -->
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="/operator/create">Operator</a></li>
                          <li><a href="/sopir/create">Sopir</a></li>
                          <li><a href="/feeder/create">Feeder</a></li>
                          <li><a href="/pemesan/create">Pemesan</a></li>


                        </ul>
                      </div>
                </div>

            <div class="box-body">
                <table id="sortdata" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>ID Users</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <!-- <th>Username</th>
                        <th>Email</th> -->
                        <th>Kontak</th>
                        <th>Jenis Kelamin</th>
                        <th>OPSI</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach($users as $u)
                            <tr>
                                <td>{{ $u->id_users }}</td>     
                                <td>{{ $u->nama }}</td>
                                <td>
                                  @if($u->role == 1)
                                           Operator
                                  @elseif($u->role == 2)
                                            Sopir
                                  @elseif($u->role == 3)
                                            Feeder
                                  @elseif($u->role == 4)
                                            Pemesan
                                  @endif
                                </td>
                                
                                <!-- <td>{{ $u->username }}</td>
                                <td>{{ $u->email }}</td> -->
                                <td>{{ $u->kontak }}</td>
                                <td>
                                        @if($u->jenis_kelamin == 1)
                                           Laki-laki
                                        @else
                                            Perempuan
                                        @endif

                                </td>
                                <td>
                                    
                                          
                                    @if($u->role == 1)
                                        <a href="/operator/show/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-eye"></i></a>

                                        <a href="/operator/edit/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/operator/delete/{{ $u->id_users }}"><i class="fa fa-trash"></i></a>
                                          
                                    @elseif($u->role == 2)
                                        <a href="/sopir/show/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-eye"></i></a>

                                        <a href="/sopir/edit/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/sopir/delete/{{ $u->id_users }}"><i class="fa fa-trash"></i></a>  

                                      @elseif($u->role == 3)
                                        <a href="/feeder/show/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-eye"></i></a>

                                        <a href="/feeder/edit/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/feeder/delete/{{ $u->id_users }}"><i class="fa fa-trash"></i></a>

                                      @elseif($u->role == 4)
                                        <a href="/pemesan/show/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-eye"></i></a>

                                        <a href="/pemesan/edit/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/pemesan/delete/{{ $u->id_users }}"><i class="fa fa-trash"></i></a>
                                      @endif
                                    

                                    
                                </td>
                            </tr>

                      <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <b>Anda yakin ingin menghapus data user ini ?</b><br><br>
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