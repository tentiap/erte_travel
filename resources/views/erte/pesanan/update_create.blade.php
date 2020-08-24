@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Penumpang di Pesanan {{$pesanan->id_pesanan}}<small>(Trip {{$pesanan->id_trip}} )</small> 
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/pesanan">Pesanan</a></li>
            <li class="active">Tambah Penumpang</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            @include('messages')
            <div class="box-body">        
                <form method="get" action="/pesanan/update_detail/{{$pesanan->id_pesanan}}/{{$pesanan->id_trip}}/{{$pesanan->id_users_pemesan}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                        <label>Kota Asal</label>
                                                        <select class="form-control" name="id_kota_asal" id="id_kota_asal" disabled>
                                                            <option disabled selected value> -- Kota Asal -- </option>
                                                                @foreach($kota as $k)
                                                                        <option value="{{ $k->id_kota }}" {{$pesanan->trip->id_kota_asal == $k->id_kota ? 'selected' : ''}}>
                                                                        {{$k->nama_kota}}
                                                                        </option>
                                                                @endforeach 
                                                        </select>

                                                        <input type="hidden" name="id_kota_asal" value="{{$pesanan->trip->id_kota_asal}}">
                                                </div>

                                                <div class="col-sm-6">
                                                        <label>Kota Tujuan</label>
                                                        <select class="form-control" name="id_kota_tujuan" id="id_kota_tujuan" disabled>
                                                            <option disabled selected value> -- Kota Tujuan -- </option>
                                                            @foreach($kota as $k)
                                                                        <option value="{{ $k->id_kota }}" {{$pesanan->trip->id_kota_tujuan == $k->id_kota ? 'selected' : ''}}>
                                                                        {{$k->nama_kota}}
                                                                        </option>
                                                            @endforeach                                                            
                                                        </select>
                                                        <input type="hidden" name="id_kota_tujuan" value="{{$pesanan->trip->id_kota_tujuan}}">
                                                </div>                                                
                                            </div>


                                                <label>Jadwal</label>
                                                    <div class='input-group date'>
                                                        <input type='text' class="form-control" name="tanggal" value="{{ date('d M Y (H:i)', strtotime($pesanan->trip->jadwal)) }}" disabled/>
                                                              <span class="input-group-addon">
                                                                  <span class="glyphicon glyphicon-calendar"></span>
                                                              </span>
                                                        @if($errors->has('tanggal'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('tanggal')}}
                                                            </div>
                                                        @endif      
                                                    </div>

                                                    <input type="hidden" name="tanggal" value="{{$pesanan->trip->jadwal}}">    
                                            </div>
                                                
                                            <!-- <div class="col-sm-6"> -->
                                           
                                                    <label>Nama Pemesan</label>
                                                        <select class="form-control" name="id_users_pemesan" disabled>
                                                            <option disabled selected value> -- Nama Pemesan -- </option>
                                                                @foreach($pemesan as $p)
                                                                        <option value="{{ $p->id_users }}" {{$pesanan->pemesan->id_users == $p->id_users ? 'selected' : ''}}>
                                                                        {{$p->nama}}
                                                                        </option>
                                                                @endforeach 
                                                        </select>
                                                
                                                    @if($errors->has('id_users_pemesan'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('id_users_pemesan')}}
                                                            </div>
                                                    @endif

                                                    <label>Jumlah seat yang sudah dibooking</label>
                                                        <input type='text' class="form-control" name="jumlah" value="{{$jumlah}}" disabled/>
                                                                                                                
                                                    </select>

                                                    <label>Jumlah seat yang ingin ditambah</label>
                                                    <select class="form-control" name="jumlah_penumpang">
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