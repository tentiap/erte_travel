@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Kota
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/kota">Kota</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                    
                <form method="post" action="/kota/update/{{ $kota->id_kota }}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id_kota" class="form-control" placeholder="ID Kota" value=" {{ $kota->id_kota }}">

                            @if($errors->has('id_kota'))
                                <div class="text-danger">
                                    {{ $errors->first('id_kota')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <textarea name="nama_kota" class="form-control" placeholder="Nama Kota"> {{ $kota->nama_kota }} </textarea>

                             @if($errors->has('nama_kota'))
                                <div class="text-danger">
                                    {{ $errors->first('nama_kota')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <a class="btn btn-default btn-close" href="/kota">Cancel</a>
                        </div>

                    </form>

            </div>
        </div>
    </section>

    
@endsection