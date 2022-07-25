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
                            <label>Rute</label>
                            <select class="form-control" id="id_trip" name="id_trip">
                                    @foreach($trip as $t)
                                        <option value="{{$t}}">
                                            
                                        </option> 
                                    @endforeach

                                    @if($errors->has('id_trip'))
                                        <div class="text-danger">
                                            {{ $errors->first('id_trip')}}
                                        </div>
                                    @endif 
                            </select>
                        </div>
                        
                        <div class="form-group" id="form_date-time">
                            <label>Tanggal dan Jam</label>
                            <select class="form-control" onchange="" id="id_date-time" name="bangke">
                                    
                                    @if($errors->has('id_trip'))
                                        <div class="text-danger">
                                            {{ $errors->first('id_trip')}}
                                        </div>
                                    @endif 
                            </select>
                        </div>

                       
 
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div

                        

                        

                        
                            

                            

                        

                        
                </form>
            </div>
        </div>
    </section>

    
@endsection

@section('cs')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#form_date-time").hide()
        });
        
        function getDateTime(){
                let tes = $("#id_rute option:selected").val()
                
                $.ajax({
                            url: "/api/pesanan/date-time/" + tes,
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
    </script>
@endsection



////////detail.blade
@for ($i = 0; $i < $jumlah_penumpang; $i++)

                                {{ csrf_field() }}

                                 <input id="invisible_id" name="invisible" type="hidden" value="secret1">

                            <div class="box box-default collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Detail Penumpang {{$i + 1}}</h3>
                                    <small>
                                        Seat yang sudah diisi : 
                                            @foreach($seat_b as $sb)
                                                @if(empty($sb->id_seat))
                                                  <p>Belum ada</p>
                                                @else
                                                  {{$sb->id_seat}},
                                                @endif                                               
                                            @endforeach      
                                    </small>

                                    <small>
                                        Seat yang belum diisi : 
                                            @for($a = 1; $a <= 7; $a++)

                                                @if(in_array($a, $seat_booked) == false)
                                                    {{ $a }},
                                                @endif    
                                                                                          
                                            @endfor      
                                    </small>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Nama</label>
                                                <input type="text" name="nama_penumpang[]" class="form-control" placeholder="Nama" value="{{ old('nama_penumpang') }}">

                                                    @if($errors->has('nama_penumpang'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('nama_penumpang')}}
                                                        </div>
                                                    @endif
                                            </div>

                                            <div class="col-sm-3">
                                                <label>Seat</label>
                                                <select class="form-control" name="id_seat[]" id="id_kota_asal">
                                                    <option disabled selected value>  Seat  </option>
                                                      
                                                        @for($i = 1; $i <= 7; $i++)

                                                            @if(in_array($i, $seat_booked) == false)
                                                                <option value="{{ $i }}">
                                                                    {{$i}}
                                                                </option> 
                                                            @endif    
                                                                                          
                                                        @endfor    
                                                </select>

                                                 @if($errors->has('id_seat'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('id_seat')}}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-sm-3">
                                                <label>Jenis Kelamin</label>
                                                <select class="form-control" name="jenis_kelamin[]">
                                                    <option disabled selected value> Jenis Kelamin </option>
                                                        <option value="Laki-laki">
                                                            Laki-laki
                                                        </option>

                                                        <option value="Perempuan">
                                                            Perempuan
                                                        </option>  
                                                       
                                                </select>
                                              
                                                @if($errors->has('jenis_kelamin'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('jenis_kelamin')}}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Detail Asal</label>
                                                <textarea name="detail_asal[]" class="form-control" placeholder="Alamat asal penumpang" value="{{ old('detail_asal') }}"></textarea> 

                                                    @if($errors->has('detail_asal'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('detail_asal')}}
                                                        </div>
                                                    @endif
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Detail Tujuan</label>
                                                <textarea name="detail_tujuan[]" class="form-control" placeholder="Alamat tujuan penumpang" value="{{ old('detail_tujuan') }}"></textarea> 

                                                    @if($errors->has('detail_tujuan'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('detail_tujuan')}}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Nomor HP</label>
                                                <input type="text" name="no_hp[]" class="form-control" placeholder="Nomor HP jika berbeda dengan pemesan" value="{{ old('no_hp') }}">

                                                    @if($errors->has('no_hp'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('no_hp')}}
                                                        </div>
                                                    @endif
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Biaya Tambahan</label>
                                                <input type="number" name="biaya_tambahan[]" class="form-control" placeholder="Biaya Tambahan" value="{{ old('biaya_tambahan') }}">

                                                    @if($errors->has('biaya_tambahan'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('biaya_tambahan')}}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>



                                  </div>
                                <!-- <div class="box-body"> -->
                            </div>
                        <!-- /.box -->
                        @endfor