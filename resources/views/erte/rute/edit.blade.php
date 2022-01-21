@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Rute
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/rute">Rute</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                                   
                <form method="post" action="/rute/update/{{ $rute->id_kota_asal }}/{{ $rute->id_kota_tujuan }}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>Kota Asal</label>
                                <select class="form-control" name="id_kota_asal" >
                                    <option disabled selected value> -- Kota Asal -- </option>
                                        @foreach($kota_asal as $k)       
                                            <option value="{{ $k->id_kota }}" {{($rute->id_kota_asal == $k->id_kota)  ? 'selected' : ''}}>{{ $k->nama_kota}}</option>
                                        @endforeach
                                </select>
                        </div>

                        <div class="form-group">
                            <label>Kota Tujuan</label>
                                <select class="form-control" name="id_kota_tujuan">
                                    <option disabled selected value> -- Kota Tujuan -- </option>
                                        @foreach($kota_asal as $k)
                                            <option value="{{ $k->id_kota }}" {{$rute->id_kota_tujuan == $k->id_kota  ? 'selected' : ''}}>{{ $k->nama_kota}}</option>
                                        @endforeach
                                </select>
                        </div>

                        <div class="form-group">
                            <label>Tarif</label>
                            <input type="text" name="tarif" class="form-control" placeholder="Tarif" value="{{$rute->tarif}}">


                            @if($errors->has('tarif'))
                                <div class="text-danger">
                                    {{ $errors->first('tarif')}}
                                </div>
                            @endif

    
                        </div>


                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <a class="btn btn-default btn-close" href="/rute">Cancel</a>
                        </div>

                    </form>
                        <!-- <button class="btn btn-default btn-close"><a href="/rute">Cancel</a></button> -->

            </div>
        </div>
    </section>

    
@endsection