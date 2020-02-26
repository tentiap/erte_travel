@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Detail Pesanan
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/pesanan">Pesanan</a></li>
            <li><a href="/detail_pesanan">Detail Pesanan</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                    
                <form method="post" action="/detail_pesanan/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>ID Trip</label>
                            <select class="form-control" name="id_trip">
                                    @foreach($trip as $t)
                                        <option name="id_trip" value="{{$t->id_trip}}">{{$t->rute->kota_asal->nama_kota}} - {{$t->rute->kota_tujuan->nama_kota}} -
                                        {{$t->tanggal}} - {{$t->jam}} </option> 
                                    @endforeach

                                    @if($errors->has('id_trip'))
                                <div class="text-danger">
                                    {{ $errors->first('id_trip')}}
                                </div>
                            @endif
                                    
                            </select>

                            

                        </div>

                        <div class="form-group">
                            <label>Pemesan</label>

                             <select class="form-control" name="id_users_pemesan">
                                   

                                    @foreach($users as $u)
                                        @if($u->role == 4)
                                            <option name="id_users_pemesan" value="{{$u->id_users}}">{{$u->nama}}</option> 
                                        @endif
                                    @endforeach
                                    
                            </select>

                            @if($errors->has('id_users_pemesan'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users_pemesan')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>ID Seat</label>

                             <select class="form-control" name="id_seat">
                                   

                                    @foreach($seat as $s)
                                        
                                            <option name="id_seat" value="{{$s->id_seat}}">{{$s->posisi}}</option> 
                                        
                                    @endforeach
                                    
                            </select>

                            @if($errors->has('id_seat'))
                                <div class="text-danger">
                                    {{ $errors->first('id_seat')}}
                                </div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label>Nama Penumpang</label>
                           
                           
                            <input type="text" name="nama_penumpang" class="form-control" placeholder="Nama Penumpang" value="{{ old('nama_penumpang') }}">


                             @if($errors->has('nama_penumpang'))
                                <div class="text-danger">
                                    {{ $errors->first('nama_penumpang')}}
                                </div>
                            @endif

                        </div>

                        <div class = "form-group">
                            <label>Jenis Kelamin</label>
                            <br>
                                <label class = "radio-inline">
                                    <input type="radio" name="jenis_kelamin" value="1"> Laki-laki
                                </label>
                                <label class = "radio-inline"> 
                                    <input type="radio" name="jenis_kelamin" value="2"> Perempuan 
                                </label>
                        </div>


                             @if($errors->has('jenis_kelamin'))
                                <div class="text-danger">
                                    {{ $errors->first('jenis_kelamin')}}
                                </div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label>Detail Asal</label>
                            <br>
                            <input type="text" name="detail_asal" class="form-control" placeholder="Detail Asal" value="{{ old('detail_asal') }}">
                            

                             @if($errors->has('detail_asal'))
                                <div class="text-danger">
                                    {{ $errors->first('detail_asal')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Detail Tujuan</label>

                            <input type="text" name="detail_tujuan" class="form-control" placeholder="Detail Tujuan" value="{{ old('detail_tujuan') }}">

                             @if($errors->has('detail_tujuan'))
                                <div class="text-danger">
                                    {{ $errors->first('detail_tujuan')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>No. HP</label>
                            <input type="number" name="no_hp" class="form-control" placeholder="Nomor HP" value="{{old('no_hp')}}">

                             @if($errors->has('no_hp'))
                                <div class="text-danger">
                                    {{ $errors->first('no_hp')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Biaya Tambahan</label>
                            <input type="number" name="biaya_tambahan" class="form-control" placeholder="Biaya Tambahan" value="{{old('biaya_tambahan')}}">

                             @if($errors->has('biaya_tambahan'))
                                <div class="text-danger">
                                    {{ $errors->first('no_hp')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div

                        

                        

                        
                            

                            

                        

                        
                </form>
            </div>
        </div>
    </section>

    
@endsection