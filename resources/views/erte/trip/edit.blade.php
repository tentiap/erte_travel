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
                    
                <form method="post" action="/trip/update/{{$trip->jadwal}}/{{$trip->plat_mobil}}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>Plat Mobil</label>
                            <input type="text" name="plat_mobil" class="form-control" placeholder="Plat Mobil" value="{{old('plat_mobil', $trip->plat_mobil)}}" disabled>

                             @if($errors->has('id_trip'))
                                <div class="text-danger">
                                    {{ $errors->first('id_trip')}}
                                </div>
                            @endif

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                    <label>Kota Asal</label>
                                    <select class="form-control" name="id_kota_asal" id="id_kota_asal"> 
                                            @foreach($kota as $k)
                                                    <option value="{{ $k->id_kota }}"{{$trip->id_kota_asal == $k->id_kota ? 'selected' : ''}}>
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
                                            @foreach($kota as $k)
                                                    <option value="{{ $k->id_kota }}"{{$trip->id_kota_tujuan == $k->id_kota ? 'selected' : ''}}>
                                                    {{$k->nama_kota}}
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
                                <div class='input-group date' id='datetime_edit'>
                                    <input type='text' class="form-control" name="jadwal" value="{{ $trip->jadwal }}" />
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
                                <option value=""> -- Sopir -- </option>
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
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <a class="btn btn-default btn-close" href="/trip">Cancel</a>
                        </div>
                    </form>

                        <!-- <button class="btn btn-default btn-close"><a href="/trip">Cancel</a></button>
                        </div> -->
                        
                
            </div>
        </div>
    </section>

    
@endsection