@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Kota
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../kota">Kota</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
              <!--   <a href="../kota" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/> -->
                    
                <form method="post" action="/kota/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id_kota" class="form-control" placeholder="ID kota" value="{{ old('id_kota') }}">

                            @if($errors->has('id_kota'))
                                <div class="text-danger">
                                    {{ $errors->first('id_kota')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama_kota" class="form-control" placeholder="Nama kota" value="{{ old('nama_kota') }}">

                             @if($errors->has('nama_kota'))
                                <div class="text-danger">
                                    {{ $errors->first('nama_kota')}}
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