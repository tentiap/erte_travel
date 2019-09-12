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


                        <div class="form-group">
                            <label>Tanggal Pesan</label>
                           
                             <!--    <input type="hidden" name="tanggal_pesan" class="form-control" value="{{date('Y-m-d H:i:s')}}"> -->
                            <input type="date" name="tanggal_pesan" class="form-control" placeholder="Tanggal Pesan" value="{{ old('tanggal_pesan') }}">


                             @if($errors->has('tanggal_pesan'))
                                <div class="text-danger">
                                    {{ $errors->first('tanggal_pesan')}}
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