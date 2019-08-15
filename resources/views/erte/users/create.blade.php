@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Users
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../users">Users</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                <a href="../users" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    
                <form method="post" action="/users/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>ID Users</label>
                            <input type="text" name="id_users" class="form-control" placeholder="ID users">

                            @if($errors->has('id_users'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" name="role" class="form-control" placeholder="Role">

                             @if($errors->has('role'))
                                <div class="text-danger">
                                    {{ $errors->first('role')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username">

                             @if($errors->has('username'))
                                <div class="text-danger">
                                    {{ $errors->first('username')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">

                             @if($errors->has('password'))
                                <div class="text-danger">
                                    {{ $errors->first('password')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email">

                             @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama">

                             @if($errors->has('nama'))
                                <div class="text-danger">
                                    {{ $errors->first('nama')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="number" name="kontak" class="form-control" placeholder="Kontak">

                             @if($errors->has('kontak'))
                                <div class="text-danger">
                                    {{ $errors->first('kontak')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            
                                  <div class="radio">
                                    <label>
                                      <input type="radio" name="optionsLaki" id="optionsLaki" value="laki-laki" checked>
                                      Laki-laki
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                      <input type="radio" name="optionsPerempuan" id="optionsPerempuan" value="perempuan">
                                      Perempuan
                                    </label>
                                  </div>
                                  
                            </div>


                             @if($errors->has('jenis_kelamin'))
                                <div class="text-danger">
                                    {{ $errors->first('jenis_kelamin')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                </form>
            </div>
        </div>
    </section>

    
@endsection