@extends('layouts.master')



@section('breadcrumb')
    <section class="content-header">
      <h1>
          Detail Data Pengurus
      </h1>
    
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/users">Users</a></li>
            <li><a href="/pengurus">Pengurus</a></li>
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
                        <a href="/pengurus/edit/{{ $pengurus->id_users }}" class="btn btn-md" ><i class="fa fa-edit"></i> Edit</a>
                        <a class="btn btn-md" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/pengurus/delete/{{ $pengurus->id_users }}"><i class="fa fa-trash"></i> Hapus pengurus</a>
                        <a href="/pengurus/" class="btn btn-md" ><i class="fa fa-list"></i> List Pengurus</a>
                        <a href="/pengurus/create/" class="btn btn-md" ><i class="fa  fa-plus-circle"></i> Tambah Pengurus</a>                       
                    </div>
                        </br>

                    <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <b>Anda yakin ingin menghapus data pengurus ini ?</b><br><br>
                                    <a class="btn btn-danger btn-ok"> Hapus</a>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                        <script type="text/javascript">
                            //Hapus Data
                            $(document).ready(function() {
                                $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
                                    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                                });
                            });
                    </script>




                   
      
                        <div class="form-group">
                            <label>ID Users</label>
                            <input type="text" name="id_users" class="form-control"  placeholder="ID users" value="{{$users->id_users}}" readonly>

                        </div>

                        <div class="form-group">
                            <label>Role</label>

                        <input type="text" name="role" class="form-control"  placeholder="Role" value="pengurus" readonly>
                                                        
         
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
                            <label>Wilayah</label>
                            <input type="text" name="kota" class="form-control" placeholder="Wilayah" value="{{$users->pengurus->kota->nama_kota}}" readonly>

                             
                        </div>

                       


            </div>
        </div>
    </section>

    
@endsection