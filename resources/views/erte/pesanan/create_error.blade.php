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