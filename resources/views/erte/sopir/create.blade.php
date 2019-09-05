@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Tambah Data Sopir
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/users">Users</a></li>
            <li><a href="/sopir">Sopir</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
               <!--  <a href="../sopir" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/> -->
                    
                <form method="post" action="/sopir/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>ID Users</label>
                            <input type="text" name="id_users" class="form-control" placeholder="ID users" value="{{ old('id_users') }}">

                           

                        </div>

                        <div class="form-group">
                            <label>Role</label>


                            <select class="form-control" name="role">
                                    
                                    <option name="role" value="2">Sopir</option> 
                                    
                            </select>

                            
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">

                            
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">

                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">

                            
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}">

                             
                        </div>

                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="number" name="kontak" class="form-control" placeholder="Kontak" value="{{ old('kontak') }}">

                             
                        </div>

                        
                        <div class = "form-group">
                            <label>Jenis Kelamin</label>
                            <br>
                                <label class = "radio-inline">
                                    <input type="radio" name="jenis_kelamin" value="1"> Laki-laki
                                </label>
                                <label class = "radio-inline"> 
                                    <input type="radio" name="jenis_kelamin" value="2"> Perempuan 
                                </label>
                        </div>


                           

                            <div class="form-group">
                            <label>Plat Mobil</label>
                            <input type="text" name="plat_mobil" class="form-control" placeholder="Plat Mobil" value="{{ old('plat_mobil') }}">

                             
                        </div>

                        <div class="form-group">
                            <label>Merek Mobil</label>
                            <input type="text" name="merek_mobil" class="form-control" placeholder="Merek Mobil" value="{{ old('merek_mobil') }}">

                             
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