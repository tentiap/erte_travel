@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Trip
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/trip">Trip</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            @include('messages')
            <div class="box-body">
                    
                <form method="post" action="/trip/store">

                        {{ csrf_field() }}

                        <!-- <div class="form-group">
                            <label>ID Trip</label>
                            <input type="text" name="id_trip" class="form-control" placeholder="ID trip" value="{{ old('id_trip') }}">

                             @if($errors->has('id_trip'))
                                <div class="text-danger">
                                    {{ $errors->first('id_trip')}}
                                </div>
                            @endif
                        </div> -->

                        <div class="row">
                            <div class="col-sm-6">
                                    <label>Kota Asal</label>
                                    <select class="form-control" name="id_kota_asal" id="id_kota_asal">
                                        <option disabled selected value> -- Kota Asal -- </option>
                                            @foreach($kota as $k)
                                                    <option value="{{ $k->id_kota }}">
                                                    {{$k->nama_kota}}
                                                    </option> 
                                            @endforeach 
                                    </select>
                            </div>

                                @if($errors->has('id_kota_asal'))
                                    <div class="text-danger">
                                        {{ $errors->first('id_kota_asal')}}
                                    </div>
                                @endif

                            <div class="col-sm-6">
                                    <label>Kota Tujuan</label>
                                    <select class="form-control" name="id_kota_tujuan" id="id_kota_tujuan">
                                        <option disabled selected value> -- Kota Tujuan -- </option>
                                            <!-- @foreach($rute as $r)
                                                    <option name="id_kota_tujuan" value="{{ $r->id_kota_tujuan }}">
                                                    {{$r->kota_tujuan->nama_kota}}
                                                    </option> 
                                            @endforeach  -->
                                    </select>
                            </div>

                                @if($errors->has('id_kota_tujuan'))
                                    <div class="text-danger">
                                        {{ $errors->first('id_kota_tujuan')}}
                                    </div>
                                @endif
                    </div>

                        <div class="form-group">
                            <label>Jadwal</label>
                                <div class='input-group date' id='datetime'>
                                    <input type='text' class="form-control" name="jadwal" value="{{  old('jadwal') }}" />
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                </div>

                                @if($errors->has('jadwal'))
                                        <div class="text-danger">
                                            {{ $errors->first('jadwal')}}
                                        </div>
                                @endif
                        </div>

                        <!-- <div class="form-group">
                            <label>Jadwal</label>
                            <input type="datetime-local" name="jadwal" class="form-control" placeholder="Jadwal" value="{{ old('jadwal') }}">

                             @if($errors->has('jadwal'))
                                <div class="text-danger">
                                    {{ $errors->first('jadwal')}}
                                </div>
                            @endif

                        </div> -->

                        <div class="form-group">
                            <label>Sopir</label>
                                <select class="form-control" name="id_users_sopir">
                                    <option value=""> -- Sopir -- </option>
                                        @foreach($sopir as $s)
                                            <option name="id_users_sopir" value="{{$s->id_users}}">{{$s->nama}}</option> 
                                        @endforeach                                        
                                </select>

                            @if($errors->has('id_users_sopir'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users_sopir')}}
                                </div>
                            @endif

                            
                        </div>

                        <!-- <div class="form-group">
                            <label>Operator</label>
                                <select class="form-control" name="id_users_operator">
                                    <option disabled selected value> -- Operator -- </option>
                                        @foreach($operator as $o)
                                                <option name="id_users_operator" value="{{$o->id_users}}">{{$o->nama}}</option> 
                                        @endforeach
                                        
                                </select>

                            @if($errors->has('id_users_operator'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users_operator')}}
                                </div>
                            @endif
                        </div> -->
                
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <!-- <button class="btn btn-default btn-close"><a href="/trip">Cancel</a></button> -->
                            <a class="btn btn-default btn-close" href="/trip">Cancel</a>
                        </div>                 
                </form>
            </div>
        </div>
    </section>

        <!--  -->
    
@endsection