@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Mobil
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/mobil">Mobil</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                    
                <form method="post" action="/mobil/update/{{$mobil->plat_mobil}}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>Plat Mobil</label>
                            <input type="text" name="plat_mobil" class="form-control" placeholder="Plat Mobil" value="{{old('plat_mobil', $mobil->plat_mobil)}}" >

                             @if($errors->has('plat_mobil'))
                                <div class="text-danger">
                                    {{ $errors->first('plat_mobil')}}
                                </div>
                            @endif

                        </div>

                        <!-- <div class="form-group">
                            <label>Sopir</label>
                            <select class="form-control" name="id_sopir">
                                <option disabled selected value>---Sopir---</option>
                                    @foreach($sopir as $s)
                                        <option value="{{ $s->id_sopir }}" {{$mobil->id_sopir == $s->id_sopir  ? 'selected' : ''}}>{{ $s->nama}}</option>
                              @endforeach
                                    
                            </select>

                            @if($errors->has('id_sopir'))
                                <div class="text-danger">
                                    {{ $errors->first('id_sopir')}}
                                </div>
                            @endif

                            
                        </div> -->

                        <div class="form-group">
                            <label>Merek Mobil</label>
                            <input type="text" name="merek_mobil" class="form-control" placeholder="Merek Mobil" value="{{old('merek_mobil', $mobil->merek_mobil)}}">

                             @if($errors->has('merek_mobil'))
                                <div class="text-danger">
                                    {{ $errors->first('merek_mobil')}}
                                </div>
                            @endif

                        </div>

                    
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <!-- <button class="btn btn-default btn-close"><a href="/feeder">Cancel</a></button> -->
                            <a class="btn btn-default btn-close" href="/feeder">Cancel</a>
                        </div>


                        </div>
       
                </form>
            </div>
        </div>
    </section>

    
@endsection