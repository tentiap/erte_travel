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
                                   
                <form method="post" action="/rute/update/{{ $rute->id_rute }}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id_rute" class="form-control" placeholder="ID rute" value="{{ $rute->id_rute }}         "> 

                             @if($errors->has('id_rute'))
                                <div class="text-danger">
                                    {{ $errors->first('id_rute')}}
                                </div>
                            @endif                 
                        </div>


                        <div class="form-group">
                            <label>Kota Asal</label>
                                <select class="form-control" name="id_kota_asal" >
                            
                                    <!-- <option name="id_kota_asal">{{$rute->kota_asal->nama_kota}}</option> -->
                                 @foreach($kota_asal as $k)
                                        
                                        <option value="{{ $k->id_kota }}" {{$rute->id_kota_asal == $k->id_kota  ? 'selected' : ''}}>{{ $k->nama_kota}}</option>
                                    @endforeach
                                   
                                </select>

    

                        </div>

                        <div class="form-group">
                            <label>Kota Tujuan</label>
                                <select class="form-control" name="id_kota_tujuan">
                                   
                                    <!-- <option name="id_kota_tujuan" >{{$rute->kota_tujuan->nama_kota}}</option>  -->

                                <option value="{{ $k->id_kota }}" {{$rute->id_kota_tujuan == $k->id_kota  ? 'selected' : ''}}>{{ $k->nama_kota}}</option>
                                    @endforeach
                                   
                            </select>

    
                     </div>



                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" class="form-control" placeholder="Harga" value="{{$rute->harga}}">

                            @if($errors->has('harga'))
                                <div class="text-danger">
                                    {{ $errors->first('harga')}}
                                </div>
                            @endif

    
                        </div>


                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>

                    </form>

            </div>
        </div>
    </section>

    
@endsection