@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Rute
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../rute">Rute</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                <a href="../rute" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    
                <form method="post" action="/rute/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>ID Rute</label>
                            <input type="text" name="id_rute" class="form-control" placeholder="ID rute">

                            @if($errors->has('id_rute'))
                                <div class="text-danger">
                                    {{ $errors->first('id_rute')}}
                                </div>
                            @endif

                        </div>



                        <div class="form-group">
                            <label>Kota Asal</label>
                                <select class="form-control">
                                    @foreach($rute as $r)
                                    <option>{{$r->kota->nama_kota}}</option> 
                                    @endforeach
                            </select>

                            <select class="form-control">
                                    @foreach($kota as $k)
                                    <option value="{{$k->id_kota}}">{{$k->nama_kota}}</option> 
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
                            
                            <select class="form-control">
                                @foreach($rute as $r)
                                <option>{{ $r->kota->nama_kota }}</option> 
                                @endforeach
                            </select>

                           <!--   <select class="form-control">
                                    @foreach($kota as $k)
                                    <option value="{{$k->id_kota}}">{{$k->nama_kota}}</option> 
                                    @endforeach
                            </select>
 -->
                             <!-- @if($errors->has('kota_tujuan'))
                                <div class="text-danger">
                                    {{ $errors->first('id_kota_tujuan')}}
                                </div>
                            @endif -->
                        </div>

                        <div class="form-group">
                            <label>Tarif</label>
                            <input type="text" name="tarif" class="form-control" placeholder="Tarif">

                           <!--  @if($errors->has('tarif'))
                                <div class="text-danger">
                                    {{ $errors->first('tarif')}}
                                </div>
                            @endif -->

                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                </form>
            </div>
        </div>
    </section>

    
@endsection