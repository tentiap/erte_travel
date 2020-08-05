@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Update Data Pesanan
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/pesanan">Pesanan</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            @include('messages')
            <div class="box-body">        
                <form method="get" action="/pesanan/update_search/{{$pesanan->id_pesanan}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                        <label>Kota Asal</label>
                                                        <select class="form-control" name="id_kota_asal" id="id_kota_asal">
                                                            <option disabled selected value> -- Kota Asal -- </option>
                                                                @foreach($kota as $k)
                                                                        <option value="{{ $k->id_kota }}" {{$pesanan->trip->id_kota_asal == $k->id_kota ? 'selected' : ''}}>
                                                                        {{$k->nama_kota}}
                                                                        </option>
                                                                @endforeach 
                                                        </select>

                                                        @if($errors->has('id_kota_asal'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('id_kota_asal')}}
                                                            </div>
                                                        @endif
                                                </div>

                                                <div class="col-sm-6">
                                                        <label>Kota Tujuan</label>
                                                        <select class="form-control" name="id_kota_tujuan" id="id_kota_tujuan">
                                                            <option disabled selected value> -- Kota Tujuan -- </option>
                                                            @foreach($kota as $k)
                                                                        <option value="{{ $k->id_kota }}" {{$pesanan->trip->id_kota_tujuan == $k->id_kota ? 'selected' : ''}}>
                                                                        {{$k->nama_kota}}
                                                                        </option>
                                                            @endforeach                                                            
                                                        </select>

                                                        @if($errors->has('id_kota_tujuan'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('id_kota_tujuan')}}
                                                            </div>
                                                        @endif
                                                </div>                                                
                                            </div>


                                                <label>Jadwal</label>
                                                    <div class='input-group date' id='date'>
                                                        <input type='text' class="form-control" name="tanggal" value="{{ $pesanan->trip->jadwal }}" />
                                                              <span class="input-group-addon">
                                                                  <span class="glyphicon glyphicon-calendar"></span>
                                                              </span>
                                                        @if($errors->has('tanggal'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('tanggal')}}
                                                            </div>
                                                        @endif      
                                                    </div>

                                                
                                            </div>
                                                
                                            <!-- <div class="col-sm-6"> -->
                                                <label>Jumlah penumpang</label>
                                                    <select class="form-control" name="jumlah_penumpang">
                                                        <option disabled selected value> -- Jumlah Penumpang -- </option>
                                                            @foreach($seat as $s)
                                                                    <option value="{{ $s->id_seat }}" {{$jumlah == $s->id_seat ? 'selected' : ''}}>
                                                                    {{$s->id_seat}}
                                                                    </option> 
                                                            @endforeach 
                                                        @if($errors->has('jumlah_penumpang'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('jumlah_penumpang')}}
                                                            </div>
                                                        @endif            
                                                            
                                                    </select>
                                                             
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary" value="Cari">
                                                    </div>                     
                                </form>                
                </form>                
            </div>            
        </div>
    </section>

    
@endsection