@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Trip
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/trip">Trip</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                    
                <form method="post" action="/trip/update/{{$trip->id_trip}}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>ID Trip</label>
                            <input type="text" name="id_trip" class="form-control" placeholder="ID Trip" value="{{old('id_trip', $trip->id_trip)}}">

                             @if($errors->has('id_trip'))
                                <div class="text-danger">
                                    {{ $errors->first('id_trip')}}
                                </div>
                            @endif

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                    <label>Kota Asal</label>
                                    <select class="form-control" name="id_kota_asal"> 
                                            @foreach($rute as $r)
                                                    <option value="{{ $r->id_kota_asal }}"{{$trip->id_kota_asal == $r->id_kota_asal ? 'selected' : ''}}>
                                                    {{$r->kota_asal->nama_kota}}
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
                                    <select class="form-control" name="id_kota_tujuan">
                                            @foreach($rute as $r)
                                                    <option name="rute" value="{{ $r->id_kota_tujuan }}"{{$trip->id_kota_tujuan == $r->id_kota_tujuan ? 'selected' : ''}}>
                                                    {{$r->kota_tujuan->nama_kota}}
                                                    </option> 
                                            @endforeach 
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
                                    <input type='text' class="form-control" name="jadwal" value="{{  old('jadwal', $trip->jadwal) }}" />
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

                       <div class="form-group">
                            <label>Sopir</label>
                            <select class="form-control" name="id_users_sopir">
                                <option disabled selected value> -- Sopir -- </option>
                                    @foreach($sopir as $s)
                                            <option  value="{{$s->id_users}}"{{$trip->id_users_sopir == $s->id_users ? 'selected' : ''}}>{{$s->nama}}</option>  
                                    @endforeach
                            </select>

                            @if($errors->has('id_users_sopir'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users_sopir')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Operator</label>
                            <select class="form-control" name="id_users_operator">
                                    @foreach($operator as $o)
                                            <option  value="{{$o->id_users}}"{{$trip->id_users_operator == $o->id_users ? 'selected' : ''}}>{{$o->nama}}</option> 
                                    @endforeach
                                    
                            </select>

                            @if($errors->has('id_users_operator'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users_operator')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <button class="btn btn-default btn-close"><a href="/trip">Cancel</a></button>
                        </div>


                        </div>
                        
                </form>
            </div>
        </div>
    </section>

    
@endsection