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
              <div class="box-header">
                <a href="/users/create" class="btn btn-primary">Tambah Users</a>
              </div>

            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>ID Users</th>
                        <th>Role</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Jenis Kelamin</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach($users as $u)
                            <tr>
                                <td>{{ $u->id_users }}</td>     
                                <td>
                                  
                                                                  
                                  {{ $u->role }}

                                </td>
                                <td>{{ $u->username }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->nama }}</td>
                                <td>{{ $u->kontak }}</td>
                                <td>{{ $u->jenis_kelamin }}</td>
                                <td>
                                    
                                    <a href="/users/edit/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                    <a href="/users/delete/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-trash"></i></a>
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