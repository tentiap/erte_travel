@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Operator
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/operator">Operator</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                    
                <form method="post" action="/operator/update/{{$operator->id_users}}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>ID Users</label>
                            <input type="text" name="id_users" class="form-control" placeholder="ID users" value="{{old('id_users', $operator->id_users)}}" disabled>

                             @if($errors->has('id_users'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{old('username', $operator->username)}}">

                             @if($errors->has('username'))
                                <div class="text-danger">
                                    {{ $errors->first('username')}}
                                </div>
                            @endif

                            
                        </div>

                        <!-- <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" >

                             @if($errors->has('password'))
                                <div class="text-danger">
                                    {{ $errors->first('password')}}
                                </div>
                            @endif

                        </div> -->

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{old('email', $operator->email)}}">

                             @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                            @endif

                            
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{old('nama', $operator->nama)}}">

                            @if($errors->has('nama'))
                                <div class="text-danger">
                                    {{ $errors->first('nama')}}
                                </div>
                            @endif

                             
                        </div>

                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" placeholder="Kontak" value="{{old('kontak', $operator->kontak)}}">

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
                                    <input type="radio" name="jenis_kelamin" value="1" {{ $operator->jenis_kelamin == 1 ? 'checked' : '' }} > Laki-laki
                                </label>
                                <label class = "radio-inline"> 
                                    <input type="radio" name="jenis_kelamin" value="2" {{ $operator->jenis_kelamin == 2 ? 'checked' : '' }}> Perempuan 
                                </label>

                                @if($errors->has('jenis_kelamin'))
                                    <div class="text-danger">
                                        {{ $errors->first('jenis_kelamin')}}
                                    </div>
                                @endif

                              
                        </div>

                        <div class="form-group">
                            <label>Wilayah</label>

                            <select class="form-control" name="id_kota">
                                <option disabled selected value>---Wilayah---</option>
                                    @foreach($kota as $k)
                                        <!-- <option name="id_kota" value="{{$operator->kota->nama_kota}}">{{$k->nama_kota}}</option>  -->
                                        <option value="{{ $k->id_kota }}" {{$operator->id_kota == $k->id_kota  ? 'selected' : ''}}>{{ $k->nama_kota}}</option>
                                    @endforeach
                                    
                            </select>
<!--  -->
                            @if($errors->has('id_kota'))
                                <div class="text-danger">
                                    {{ $errors->first('id_kota')}}
                                </div>
                            @endif

                            
                        </div>

                        

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <button class="btn btn-default btn-close"><a href="/operator">Cancel</a></button>
                        </div>


                        </div>
                        

                        

                        
                </form>
            </div>
        </div>
    </section>

    
@endsection