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
            @include('messages')
            <div class="box-body">
                    
                <form method="post" action="/pesanan/create_search">
                        {{ csrf_field() }}
                        <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                    <label>Kota Asal</label>
                                    <select class="form-control" name="id_kota_asal" id="id_kota_asal">
                                        <option disabled selected value> -- Kota Asal -- </option>
                                            @foreach($kota as $k)
                                                    <option value="{{ $k->id_kota }}">
                                                    {{$k->nama_kota}}
                                                    </option> 
                                            @endforeach 
                                    </select>
                            </div>

                                @if($errors->has('id_kota_asal'))
                                    <div class="text-danger">
                                        {{ $errors->first('id_kota_asal')}}
                                    </div>
                                @endif

                            <div class="col-sm-6">
                                    <label>Kota Tujuan</label>
                                    <select class="form-control" name="id_kota_tujuan" id="id_kota_tujuan">
                                        <option disabled selected value> -- Kota Tujuan -- </option>
                                            
                                    </select>
                            </div>

                                @if($errors->has('id_kota_tujuan'))
                                    <div class="text-danger">
                                        {{ $errors->first('id_kota_tujuan')}}
                                    </div>
                                @endif
                        </div>

                        <!-- <div class="row">
                            <div class="col-sm-6"> -->
                                <label>Jadwal</label>
                                    <div class='input-group date' id='date'>
                                        <input type='text' class="form-control" name="tanggal" value="{{  old('tanggal') }}" />
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                    </div>

                                @if($errors->has('tanggal'))
                                        <div class="text-danger">
                                            {{ $errors->first('tanggal')}}
                                        </div>
                                @endif
                            </div>
                                
                            <!-- <div class="col-sm-6"> -->
                                <label>Jumlah penumpang</label>
                                    <select class="form-control" name="jumlah_penumpang">
                                        <option disabled selected value> -- Jumlah Penumpang -- </option>
                                            @for($i=0; $i < 7; $i++)
                                                <option value="{{ $i+1 }}">
                                                {{ $i+1 }}
                                                </option> 
                                            @endfor
                                    </select>
                            <!-- </div> -->
                                @if($errors->has('jumlah_penumpang'))
                                        <div class="text-danger">
                                            {{ $errors->first('jumlah_penumpang')}}
                                        </div>
                                @endif

                                <label>Nama Pemesan</label>
                                    <select class="form-control" name="id_pemesan">
                                        <option disabled selected value> -- Nama Pemesan -- </option>
                                            @foreach($pemesan as $p)
                                                    <option value="{{ $p->id_pemesan }}">
                                                    {{$p->nama}}
                                                    </option> 
                                            @endforeach 
                                    </select>
                            
                                @if($errors->has('id_pemesan'))
                                        <div class="text-danger">
                                            {{ $errors->first('id_pemesan')}}
                                        </div>
                                @endif

                                <a data-toggle='modal' data-target='#tambah_pemesan' style="position: absolute; right: 16px;">Buat akun pemesan</a>

                                                    
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Cari">
                                    </div>                     
                </form>                
            </div>
                    

            <div class="modal fade" id="tambah_pemesan" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Tambah Data Pemesan</b></h4>
                                            </div> 
                                            <div class="modal-body">
                                                <div class="form-group">
                                                  <form method="post" action="/pemesan/store">

                                                        {{ csrf_field() }}

                                                        
                                                        <div class="form-group">
                                                            <label>ID_Pemesan</label>
                                                            <input type="text" name="id_pemesan" class="form-control" placeholder="ID Pemesan"  value="{{ old('id_pemesan') }}">

                                                            @if($errors->has('id_pemesan'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('id_pemesan')}}
                                                                </div>
                                                            @endif

                                                        </div>

                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input type="text" name="username" class="form-control" placeholder="Username"  value="{{ old('username') }}">

                                                             @if($errors->has('username'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('username')}}
                                                                </div>
                                                            @endif

                                                        </div>

                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">

                                                             @if($errors->has('password'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('password')}}
                                                                </div>
                                                            @endif

                                                        </div>

                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">

                                                             @if($errors->has('email'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('email')}}
                                                                </div>
                                                            @endif

                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}">

                                                            @if($errors->has('nama'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('nama')}}
                                                                </div>
                                                            @endif

                                                             
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Kontak</label>
                                                            <input type="text" name="kontak" class="form-control" placeholder="Kontak" value="{{ old('kontak') }}">

                                                            @if($errors->has('kontak'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('kontak')}}
                                                                </div>
                                                            @endif

                                                             
                                                        </div>

                                                        
                                                        <div class = "form-group">
                                                            <label>Jenis Kelamin</label>
                                                            <br>
                                                                <label class = "radio-inline">
                                                                    <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
                                                                </label>
                                                                <label class = "radio-inline"> 
                                                                    <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan 
                                                                </label>

                                                            @if($errors->has('jenis_kelamin'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('jenis_kelamin')}}
                                                                </div>
                                                            @endif

                                                        </div>


                                                        <div class="form-group">
                                                            <label>Alamat</label>
                                                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ old('alamat') }}">

                                                            @if($errors->has('alamat'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('alamat')}}
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <input type="submit" class="btn btn-primary" value="Simpan">                                    
                                                    
                                                        <button type="button" class="btn btn-default" data-dismiss="modal"> Batal</button> 
                                                  </form>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>

            </div>
        </div>
    </section>

    
@endsection

@yield('trip')

@section('cs')
    <!-- <script type="text/javascript">
        $(document).ready(function () {
            $("#form_date-time").hide()
        });
        
        function getDateTime(){
                let jadwal = $("#id_rute option:selected").val()
                
                $.ajax({
                            url: "/api/pesanan/date-time/" + jadwal,
                            type: "GET",
                            contentType: "application/json;charset=utf-8",
                            dataType: "json",
                            success: function (result) {
                                $("#form_date-time").show()
                                $('#id_date-time').empty()
                                $.each(result, function (i, item) {
                                    $('#id_date-time').append($('<option>', { 
                                        value: item.tanggal+"%"+item.jam,
                                        text : "tanggal: "+item.tanggal+" jam: "+item.jam 
                                    }));
                                });     
                            },
                            error: function (errormessage) {
                                alert(errormessage.responseText);
                            }
                        });
            }
    </script> -->
@endsection
