@extends('layouts.master')



@section('breadcrumb')
    <section class="content-header">
      <h1>
          Detail Data Sopir
      </h1>
    
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/users">Users</a></li>
            <li><a href="/sopir">Sopir</a></li>
            <li class="active">Detail</li>
          </ol>

    </section>
          
 
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                <!-- <style>
                    .outset {border-style: outset;}
                </style> -->
                    <div style="position: absolute; right: 0;">
                        <a href="/sopir/edit/{{ $sopir->id_users }}" class="btn btn-md" ><i class="fa fa-edit"></i>Edit</a>
                        <a href="/sopir/delete/{{ $sopir->id_users }}" class="btn btn-md" ><i class="fa fa-trash"></i>Delete</a>
                        <a href="/sopir/index/" class="btn btn-md" ><i class="fa fa-list"></i>List Sopir</a>
                        <a href="/sopir/create/" class="btn btn-md" ><i class="fa  fa-plus-circle"></i>Tambah Sopir</a>


                        
                    </div>
                        </br>
                   
      
                        <div class="form-group">
                            <label>ID Users</label>
                            <input type="text" name="id_users" class="form-control"  placeholder="ID users" value="{{$users->id_users}}" readonly>

                        </div>

                        <div class="form-group">
                            <label>Role</label>

                        <input type="text" name="role" class="form-control"  placeholder="Role" value="Sopir" readonly>
                                                        
                                        
                                               
                                    
                          
                             
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{$users->username}}" readonly>

                             
                        </div>

                        

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{$users->email}}" readonly>

                             
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{$users->nama}}" readonly>

                             
                        </div>

                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" placeholder="Kontak" value="{{$users->kontak}}" readonly>

                           
                        </div>

                        
                        <div class = "form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" name="jenis_kelamin" class="form-control" placeholder="Jenis Kelamin" value="<?php
                                        if($users->jenis_kelamin == 1){
                                        echo "Laki-laki";
                                        }else{
                                        echo "Perempuan";
                                        } 
                                    ?> 
                            "readonly>                                               
                      </div>

                        <div class="form-group">
                            <label>Plat Mobil</label>
                            <input type="text" name="plat_mobil" class="form-control" placeholder="Plat Mobil" value="{{$users->sopir->plat_mobil}}" readonly>

                             
                        </div>

                        <div class="form-group">
                            <label>Merek Mobil</label>
                            <input type="text" name="merek_mobil" class="form-control" placeholder="Merek Mobil" value="{{$users->sopir->merek_mobil}}" readonly>

                        </div>


            </div>
        </div>
    </section>

    
@endsection