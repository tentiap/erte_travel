@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Sopir
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/sopir">Sopir</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                <!-- <a href="/sopir" class="btn btn-primary">List Sopir</a> -->
                   <!--  <br/>
                    <br/> -->
              <!--    @include('messages') -->
                    
                <form method="post" action="/sopir/update/{{$sopir->id_users}}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>ID Users</label>
                            <input type="text" name="id_users" class="form-control" placeholder="ID users" value="{{old('id_users', $sopir->id_users)}}" disabled>

                            @if($errors->has('id_users'))
                                <div class="text-danger">
                                    {{ $errors->first('id_users')}}
                                </div>
                            @endif
                        </div>

                    
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{old('username', $sopir->username)}}">

                          @if($errors->has('username'))
                                <div class="text-danger">
                                    {{ $errors->first('username')}}
                                </div>
                            @endif   

                       
                        </div>

<!--                         <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" >

                             @if($errors->has('password'))
                                    <div class="text-danger">
                                        {{ $errors->first('password')}}
                                    </div>
                            @endif
                        </div>
 -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{old('email', $sopir->email)}}">

                            @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                            @endif

                            
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{old('nama', $sopir->nama)}}">

                             @if($errors->has('nama'))
                                <div class="text-danger">
                                    {{ $errors->first('nama')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" placeholder="Kontak" value="{{old('kontak', $sopir->kontak)}}">

                             @if($errors->has('kontak'))
                                <div class="text-danger">
                                    {{ $errors->first('kontak')}}
                                </div>
                            @endif

                             
                        </div>

                        <!-- <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <br>
                                <label class="radio-inline">
                                      <input type="radio" name="jenis_kelamin" value="Laki=laki" >Laki-laki
                                </label>
                                <label class="radio-inline">
                                      <input type="radio" name="perempuan" value="Perempuan">Perempuan
                                </label>
                                  
                            </div> -->

                        <div class = "form-group">
                            <label>Jenis Kelamin</label>
                            <br>
                                <label class = "radio-inline">
                                    <input type="radio" name="jenis_kelamin" value="1" {{ $sopir->jenis_kelamin == 1 ? 'checked' : '' }} > Laki-laki
                                </label>
                                <label class = "radio-inline"> 
                                    <input type="radio" name="jenis_kelamin" value="2" {{ $sopir->jenis_kelamin == 2 ? 'checked' : '' }}> Perempuan 
                                </label>

                                @if($errors->has('jenis_kelamin'))
                                    <div class="text-danger">
                                        {{ $errors->first('jenis_kelamin')}}
                                    </div>
                                @endif

                              
                        </div>                     

                        <div class="form-group">
                            <label>Plat Mobil</label>
                            <input type="text" name="plat_mobil" class="form-control" placeholder="Plat Mobil" value="{{old('plat_mobil', $sopir->plat_mobil)}}">

                            @if($errors->has('plat_mobil'))
                                <div class="text-danger">
                                    {{ $errors->first('plat_mobil')}}
                                </div>
                            @endif

                           
                        <div class="form-group">
                            <label>Merek Mobil</label>
                            <input type="text" name="merek_mobil" class="form-control" placeholder="Merek Mobil" value="{{old('merek_mobil', $sopir->merek_mobil)}}">

                             @if($errors->has('merek_mobil'))
                                <div class="text-danger">
                                    {{ $errors->first('merek_mobil')}}
                                </div>
                            @endif

                           
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <button class="btn btn-default btn-close"><a href="/sopir">Cancel</a></
                        </div>    
                             
                        
                </form>
            </div>
        </div>
    </section>

    
@endsection