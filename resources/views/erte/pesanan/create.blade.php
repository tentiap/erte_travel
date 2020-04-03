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
                            <!-- <select class="form-control" onchange="getDateTime()" id="id_rute" name="id_rute"> -->
                            <select class="form-control" id="id_rute" name="id_rute">
                                    @foreach($trip as $t)
                                        <option value="{{$t->rute->kota_asal->id_kota_asal}}">{{$t->rute->kota_asal->nama_kota}}
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

                       <!--  <div class="form-group">
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
                            -->
                             <!--    <input type="hidden" name="tanggal_pesan" class="form-control" value="{{date('Y-m-d H:i:s')}}"> -->
                          <!--   <input type="date" name="tanggal_pesan" class="form-control" placeholder="Tanggal Pesan" value="{{ old('tanggal_pesan') }}">


                             @if($errors->has('tanggal_pesan'))
                                <div class="text-danger">
                                    {{ $errors->first('tanggal_pesan')}}
                                </div>
                            @endif

                        </div>
 -->
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
                let ayam = $("#id_rute option:selected").val()
                
                $.ajax({
                            url: "/api/pesanan/date-time/" + ayam,
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