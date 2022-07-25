@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Feeder
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/feeder">Feeder</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                    
                <form method="post" action="/feeder/update/{{$feeder->id_feeder}}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>ID Feeder</label>
                            <input type="text" name="id_feeder" class="form-control" placeholder="ID Feeder" value="{{old('id_feeder', $feeder->id_feeder)}}" disabled>

                             @if($errors->has('id_feeder'))
                                <div class="text-danger">
                                    {{ $errors->first('id_feeder')}}
                                </div>
                            @endif

                        </div>

                    
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{old('username', $feeder->username)}}">

                             @if($errors->has('username'))
                                <div class="text-danger">
                                    {{ $errors->first('username')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{old('email', $feeder->email)}}">

                             @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{old('nama', $feeder->nama)}}">

                            @if($errors->has('nama'))
                                <div class="text-danger">
                                    {{ $errors->first('nama')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" placeholder="Kontak" value="{{old('kontak', $feeder->kontak)}}">

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
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ $feeder->jenis_kelamin == "Laki-laki" ? 'checked' : '' }} > Laki-laki
                                </label>
                                <label class = "radio-inline"> 
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ $feeder->jenis_kelamin == "Perempuan" ? 'checked' : '' }}> Perempuan 
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
                                        <!-- <option name="id_kota" value="{{$feeder->kota->nama_kota}}">{{$k->nama_kota}}</option>  -->
                                        <option value="{{ $k->id_kota }}" {{$feeder->id_kota == $k->id_kota  ? 'selected' : ''}}>{{ $k->nama_kota}}</option>
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
                            <!-- <button class="btn btn-default btn-close"><a href="/feeder">Cancel</a></button> -->
                            <a class="btn btn-default btn-close" href="/feeder">Cancel</a>
                        </div>


                        </div>
       
                </form>
            </div>
        </div>
    </section>

    
@endsection