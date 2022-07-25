@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Feeder
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/feeder">Feeder</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            @include('messages')
            <div class="box-body">
                    
                <form method="post" action="/feeder/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>ID Feeder</label>
                            <input type="text" name="id_feeder" class="form-control" placeholder="ID Feeder" value="{{ old('id_feeder') }}">

                             @if($errors->has('id_feeder'))
                                <div class="text-danger">
                                    {{ $errors->first('id_feeder')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">

                             @if($errors->has('username'))
                                <div class="text-danger">
                                    {{ $errors->first('username')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">

                             @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                            @endif

                            
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">

                             @if($errors->has('password'))
                                <div class="text-danger">
                                    {{ $errors->first('password')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}">

                            @if($errors->has('nama'))
                                <div class="text-danger">
                                    {{ $errors->first('nama')}}
                                </div>
                            @endif

                             
                        </div>

                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" placeholder="Kontak" value="{{ old('kontak') }}">

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
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
                                </label>
                                <label class = "radio-inline"> 
                                    <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan 
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
                                <option disabled selected value> -- Wilayah -- </option>
                                @foreach($kota as $k)
                                                    <option value="{{ $k->id_kota }}">
                                                    {{$k->nama_kota}}
                                                    </option> 
                                            @endforeach
                                    
                            </select>

                            @if($errors->has('id_kota'))
                                <div class="text-danger">
                                    {{ $errors->first('id_kota')}}
                                </div>
                            @endif

                            
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <a class="btn btn-default btn-close" href="/feeder">Cancel</a>
                        </div>


                        </div>
                           
                </form>
            </div>
        </div>
    </section>

    
@endsection