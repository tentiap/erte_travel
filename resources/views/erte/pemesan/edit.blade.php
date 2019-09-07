@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Pemesan
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/users">Users</a></li>
            <li><a href="/pemesan">Pemesan</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                    
                <form method="post" action="/pemesan/update/{{$users->id_users}}">

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
                            

                            <select class="form-control" name="role">
                                    <option name="role" value="{{$users->role}}">Pemesan

                                        
                                    </option>
                                    
                            
                                    
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
                            <input type="password" name="password" class="form-control" placeholder="Password" >

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


                        <div class = "form-group">
                            <label>Jenis Kelamin</label>
                            <br>
                                <label class = "radio-inline">
                                    <input type="radio" name="jenis_kelamin" value="1" {{ $users->jenis_kelamin == 1 ? 'checked' : '' }} > Laki-laki
                                </label>
                                <label class = "radio-inline"> 
                                    <input type="radio" name="jenis_kelamin" value="2" {{ $users->jenis_kelamin == 2 ? 'checked' : '' }}> Perempuan 
                                </label>

                                @if($errors->has('jenis_kelamin'))
                                    <div class="text-danger">
                                        {{ $errors->first('jenis_kelamin')}}
                                    </div>
                                @endif

                              
                        </div>

                        


                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{$users->pemesan->alamat}}">

                            @if($errors->has('alamat'))
                                <div class="text-danger">
                                    {{ $errors->first('alamat')}}
                                </div>
                            @endif

                           
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>    
                             
                        </div>

                        
                </form>
            </div>
        </div>
    </section>

    
@endsection