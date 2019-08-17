@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Data Sopir
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../sopir">Sopir</a></li>
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
                <a href="/users/create" class="btn btn-primary">Tambah Sopir</a>
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
                        <th>Plat Mobil</th>
                        <th>Merek Mobil</th>
                        <th>OPSI</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach($users as $u)
                      @if($u->role == 2)
                            <tr>
                                <td>{{ $u->id_users }}</td>     
                                
                                <td>{{ $u->nama }}</td>
                                <td>{{ $u->username }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->kontak }}</td>
                                <td>
                                        @if($u->jenis_kelamin == 1)
                                           Laki-laki
                                        @else
                                            Perempuan
                                        @endif

                                </td>
                            @foreach($sopir as $s)    
                                <td>{{$s->plat_mobil}}</td>
                                <td>{{$s->merek_mobil}}</td>
                            @endforeach
                                <td>
                                    
                                    <a href="/users/edit/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                    <a href="/users/delete/{{ $u->id_users }}" class="btn btn-lg"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                      @endif      
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