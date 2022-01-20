@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Users
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/users">Users</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                <a href="/users" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    
                <form method="post" action="/users/update/{{$users->id_users}}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>ID Users</label>
                            <input type="text" name="id_users" class="form-control" placeholder="ID users" value="{{$users->id_users}}">

                            @if($errors->has('id_users'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <!-- <input type="text" name="role" class="form-control" placeholder="Role" value="{{$users->role}}"> -->

                            <select class="form-control" name="role">
                                    <option name="role" value="{{$users->role}}">
                                        @if($users->role == 1)
                                           Pengurus
                                        @elseif($users->role == 2)
                                            Sopir
                                        @elseif($users->role == 3)
                                            Feeder
                                        @elseif($users->role == 4)
                                            Pemesan
                                        @endif
                                    </option>
                                    
                                    <option name="role" value="1">Pengurus</option> 
                                    <option name="role" value="2">Sopir</option> 
                                    <option name="role" value="3">Feeder</option> 
                                    <option name="role" value="4">Pemesan</option>       
                            
                                    
                            </select>

                             @if($errors->has('role'))
                                <div class="text-danger">
                                    {{ $errors->first('role')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{$users->username}}">

                             @if($errors->has('username'))
                                <div class="text-danger">
                                    {{ $errors->first('username')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" value="{{$users->password}}">

                             @if($errors->has('password'))
                                <div class="text-danger">
                                    {{ $errors->first('password')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{$users->email}}">

                             @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{$users->nama}}">

                             @if($errors->has('nama'))
                                <div class="text-danger">
                                    {{ $errors->first('nama')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" placeholder="Kontak" value="{{$users->kontak}}">

                             @if($errors->has('kontak'))
                                <div class="text-danger">
                                    {{ $errors->first('kontak')}}
                                </div>
                            @endif
                        </div>

                        <!-- <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <br>
                                <label class="radio-inline">
                                      <input type="radio" name="jenis_kelamin" value="Laki=laki" >Laki-laki
                                </label>
                                <label class="radio-inline">
                                      <input type="radio" name="perempuan" value="Perempuan">Perempuan
                                </label>
                                  
                            </div> -->

                        <div class = "form-group">
                            <label>Jenis Kelamin</label>
                            <br>
                                <label class = "radio-inline">
                                    <input type="radio" name="jenis_kelamin" value="1"> Laki-laki
                                </label>
                                <label class = "radio-inline"> 
                                    <input type="radio" name="jenis_kelamin" value="2"> Perempuan 
                                </label>
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