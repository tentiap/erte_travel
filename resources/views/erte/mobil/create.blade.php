@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Mobil
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/mobil">Mobil</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            @include('messages')
            <div class="box-body">
                    
                <form method="post" action="/mobil/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Plat Mobil</label>
                            <input type="text" name="plat_mobil" class="form-control" placeholder="Plat Mobil" value="{{ old('plat_mobil') }}">

                             @if($errors->has('plat_mobil'))
                                <div class="text-danger">
                                    {{ $errors->first('plat_mobil')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Sopir</label>


                            <select class="form-control" name="id_sopir">
                                <option disabled selected value> -- Sopir -- </option>
                                @foreach($sopir as $s)
                                    <option value="{{ $s->id_sopir }}">
                                    {{$s->id_sopir}}
                                    </option> 
                                @endforeach
                                    
                            </select>

                            @if($errors->has('id_sopir'))
                                <div class="text-danger">
                                    {{ $errors->first('id_sopir')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Merek Mobil</label>
                            <input type="text" name="merek_mobil" class="form-control" placeholder="Merek Mobil" value="{{ old('merek_mobil') }}">

                             @if($errors->has('merek_mobil'))
                                <div class="text-danger">
                                    {{ $errors->first('merek_mobil')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <a class="btn btn-default btn-close" href="/feeder">Cancel</a>
                        </div>


                        </div>
                           
                </form>
            </div>
        </div>
    </section>

    
@endsection