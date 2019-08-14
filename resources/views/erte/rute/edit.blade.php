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
                <a href="/rute" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    
                <form method="post" action="/rute/update/{{ $rute->id_rute }}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id_rute" class="form-control" placeholder="ID rute" value=" {{ $rute->id_rute }}">

                            @if($errors->has('id_rute'))
                                <div class="text-danger">
                                    {{ $errors->first('id_rute')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Kota Asal</label>
                                <select class="form-control" value=" {{ $rute->id_kota_asal }}">
                                    @foreach($rute as $r)
                                    <option>{{$r->id_kota_asal}}</option> 
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
                                <select class="form-control" value=" {{ $rute->id_kota_tujuan }}">
                                    @foreach($rute as $r)
                                    <option>{{$r->id_kota_tujuan}}</option> 
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
                            <textarea name="posisi" class="form-control" placeholder="posisi"> {{ $rute->harga }} </textarea>

                             @if($errors->has('rute'))
                                <div class="text-danger">
                                    {{ $errors->first('rute')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>

                    </form>

            </div>
        </div>
    </section>

    
@endsection