@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Seat
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/seat">Seat</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
               <!--  <a href="/seat" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/> -->
<!-- 
                 @include('messages')     -->
                    
                <form method="post" action="/seat/update/{{ $seat->id_seat }}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id_seat" class="form-control" placeholder="ID seat" value=" {{ old('id_seat', $seat->id_seat) }}">

                            @if($errors->has('id_seat'))
                                <div class="text-danger">
                                    {{ $errors->first('id_seat')}}
                                </div>
                            @endif
                           
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value=" {{ old('keterangan', $seat->keterangan) }}">
                            

                             @if($errors->has('keterangan'))
                                <div class="text-danger">
                                    {{ $errors->first('keterangan')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <button class="btn btn-default btn-close"><a href="/pemesan">Cancel</a></button>
                        </div>

                    </form>

            </div>
        </div>
    </section>

    
@endsection