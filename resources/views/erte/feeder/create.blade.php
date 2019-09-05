@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Feeder
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/users">Users</a></li>
            <li><a href="/feeder">Feeder</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                    
                <form method="post" action="/feeder/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>ID Users</label>
                            <input type="text" name="id_users" class="form-control" placeholder="ID users" value="{{ old('id_users') }}">

                             @if($errors->has('id_users'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Wilayah</label>


                            <select class="form-control" name="kota">
                                    @foreach($kota as $k)
                                        <option name="kota" value="$k->nama_kota"></option> 
                                    @endforeach
                                    
                            </select>

                            @if($errors->has('kota'))
                                <div class="text-danger">
                                    {{ $errors->first('kota')}}
                                </div>
                            @endif

                            
                        </div>

                        

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>


                        </div>
                        

                        

                        
                </form>
            </div>
        </div>
    </section>

    
@endsection