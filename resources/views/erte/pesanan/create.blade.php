@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Pesanan
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
            <div class="box-body">
                    
                <form method="post" action="/pesanan/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>ID Trip</label>
                            <select class="form-control" name="id_trip">
                                    @foreach($trip as $t)
                                        <option name="id_trip" value="{{$t->id_trip}}">{{$t->rute->kota_asal->nama_kota}} - {{$t->rute->kota_tujuan->nama_kota}} -
                                        {{$t->tanggal}} - {{$t->jam}} </option> 
                                    @endforeach
                                    
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Pemesan</label>

                             <select class="form-control" name="id_rute">
                                   

                                    @foreach($users as $u)
                                        @if($u->role == 4)
                                            <option name="id_users_pemesan" value="{{$u->id_users}}">{{$u->nama}}</option> 
                                        @endif
                                    @endforeach
                                    
                            </select>


                        <div class="form-group">
                            <label>Tanggal Pesan</label>
                            <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" value="{{ old('tanggal') }}">

                             @if($errors->has('tanggal'))
                                <div class="text-danger">
                                    {{ $errors->first('tanggal')}}
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