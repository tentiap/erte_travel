@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Rute
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/rute">Rute</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                                   
                <form method="post" action="/rute/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Kota Asal</label> 
                            <select class="form-control" name="id_kota_asal">
                                <option disabled selected value> -- Kota Asal -- </option>
                                    @foreach($kota_asal as $k)
                                        <option name="id_kota_asal" value="{{$k->id_kota}}">{{$k->nama_kota}}</option> 
                                    @endforeach
                            </select>

                            @if($errors->has('id_kota_asal'))
                                <div class="text-danger">
                                    {{ $errors->first('id_kota_asal')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Kota Tujuan</label>                           
                            <select class="form-control" name="id_kota_tujuan">
                                <option disabled selected value> -- Kota Tujuan -- </option>
                                        @foreach($kota_tujuan as $kt)
                                            <option name="id_kota_tujuan" value="{{$kt->id_kota}}">{{$kt->nama_kota}}</option> 
                                        @endforeach
                            </select>

                            @if($errors->has('id_kota_tujuan'))
                                <div class="text-danger">
                                    {{ $errors->first('id_kota_tujuan')}}
                                </div>
                            @endif

                            
                        </div>

                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" class="form-control" placeholder="Harga" value="{{ old('harga') }}">

                            @if($errors->has('harga'))
                                <div class="text-danger">
                                    {{ $errors->first('harga')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <!-- <button class="btn btn-default btn-close"><a href="/rute">Cancel</a></button> -->
                            <a class="btn btn-default btn-close" href="/rute">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </section>

    
@endsection