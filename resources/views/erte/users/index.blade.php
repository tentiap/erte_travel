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
                          <li><a href="/operator/create">Feeder</a></li>
                          <li><a href="/sopir/create">Pemesan</a></li>


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
                                        <a href="/operator/delete/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-trash"></i></a>
                                          
                                    @elseif($u->role == 2)
                                        <a href="/sopir/show/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-eye"></i></a>
                                        <a href="/sopir/edit/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                        <a href="/sopir/delete/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-trash"></i></a>  

                                      @elseif($u->role == 3)
                                        <a href="/feeder/show/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-eye"></i></a>
                                        <a href="/feeder/edit/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                        <a href="/feeder/delete/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-trash"></i></a>
                                      @elseif($u->role == 4)
                                        <a href="/pemesan/show/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-eye"></i></a>
                                        <a href="/pemesan/edit/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                        <a href="/pemesan/delete/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-trash"></i></a>
                                      @endif
                                    
                                                                     
                                    
                                </td>
                            </tr>
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