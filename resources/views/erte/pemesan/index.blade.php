@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Data Pemesan
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../users">Users</a></li>
            <li><a href="../pemesan">Pemesan</a></li>
            <li class="active">Index</li>
          </ol>
  </section>
 @endsection

@section('content') 
    <section class="content">
      <div class="box">
        <div class="box-body">
          
              @include('messages')
              <div class="box-header" align="right">                
                <a href="/pemesan/create" class="btn btn-primary">Tambah Pemesan</a>
              </div>

              

            <div class="box-body">
                <table id="sortdata" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>ID Users</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Kontak</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        
                        <th>OPSI</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach($pemesan as $p)
                      
                            <tr>
                                <td>{{ $p->id_users }}</td>
                                <td>{{ $p->users->nama }}</td>          
                                <td>{{ $p->users->username }}</td>
                                <td>{{ $p->users->email }}</td>
                                <td>{{ $p->users->kontak }}</td>
                                <td>
                                        @if($p->users->jenis_kelamin == 1)
                                           Laki-laki
                                        @else
                                            Perempuan
                                        @endif

                                </td>
                               
                                <td>{{ $p->alamat}}</td>
                                
                                
                                <td>
                                    
                                    <a href="/pemesan/edit/{{ $p->id_users }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/pemesan/delete/{{ $p->id_users }}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>


                                    <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <b>Anda yakin ingin menghapus data pemesan ini ?</b><br><br>
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