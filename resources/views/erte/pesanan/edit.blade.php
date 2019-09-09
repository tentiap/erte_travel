@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Trip
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/trip">Trip</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                    
                <form method="post" action="/trip/update/{{$trip->id_trip}}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>ID Trip</label>
                            <input type="text" name="id_trip" class="form-control" placeholder="ID Trip" value="{{$trip->id_trip}}">

                             @if($errors->has('id_trip'))
                                <div class="text-danger">
                                    {{ $errors->first('id_trip')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Operator</label>


                            <select class="form-control" name="id_users_operator">
                                    @foreach($users as $u)
                                        @if($u->role == 1)
                                            <option  value="{{$u->id_users}}"{{$trip->id_users_operator == $u->id_users ? 'selected' : ''}}>{{$u->nama}}</option> 
                                        @endif
                                    @endforeach
                                    
                            </select>

                            @if($errors->has('id_users_operator'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users_operator')}}
                                </div>
                            @endif

                            
                        </div>

                       <div class="form-group">
                            <label>Sopir</label>


                            <select class="form-control" name="id_users_sopir">
                                    @foreach($users as $u)
                                        @if($u->role == 2)
                                            <option  value="{{$u->id_users}}"{{$trip->id_users_sopir == $u->id_users ? 'selected' : ''}}>{{$u->nama}}</option>  
                                        @endif
                                    @endforeach
                                    
                            </select>

                            @if($errors->has('id_users_sopir'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users_sopir')}}
                                </div>
                            @endif

                            
                        </div>

                        <div class="form-group">
                            <label>Feeder</label>


                            <select class="form-control" name="id_users_feeder">
                                    @foreach($users as $u)
                                        @if($u->role == 3)
                                            <option  value="{{$u->id_users}}"{{$trip->id_users_feeder == $u->id_users ? 'selected' : ''}}>{{$u->nama}}</option>  
                                        @endif
                                    @endforeach
                                    
                            </select>

                            @if($errors->has('id_users_feeder'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users_feeder')}}
                                </div>
                            @endif

                            
                        </div>

                        <div class="form-group">
                            <label>Rute</label>


                            <select class="form-control" name="id_rute">
                                   

                                    @foreach($rute as $r)
                                        
                                            <option  value="{{$r->id_rute}}"{{$trip->id_rute == $r->id_rute ? 'selected' : ''}}>{{$r->kota_asal->nama_kota}} - {{$r->kota_tujuan->nama_kota}}</option> 
                                        
                                    @endforeach
                                    
                            </select>

                            @if($errors->has('id_rute'))
                                <div class="text-danger">
                                    {{ $errors->first('id_rute')}}
                                </div>
                            @endif

                            
                        </div>

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" value="{{($trip->tanggal) }}">

                             @if($errors->has('tanggal'))
                                <div class="text-danger">
                                    {{ $errors->first('tanggal')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Jam</label>
                            <input type="time" name="jam" class="form-control" placeholder="Jam" value="{{ ($trip->jam) }}" >

                             @if($errors->has('jam'))
                                <div class="text-danger">
                                    {{ $errors->first('jam')}}
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