@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Data Rute
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../rute">Rute</a></li>
            <li class="active">Index</li>
          </ol>
  </section>
 @endsection

@section('content') 
    <section class="content">
      <div class="box">
        <div class="box-body">
          <!-- <div class="box"> -->
              <div class="box-header">
                <a href="/rute/create" class="btn btn-primary">Tambah Rute</a>
              </div>

            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>ID Rute</th>
                        <th>Kota Asal</th>
                        <th>Kota Tujuan</th>
                        <th>Harga</th>
                        <th>Opsi</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach($rute as $r)
                            <tr>
                                <td>{{ $r->id_rute }}</td>     
                                <td>{{ $r->kota_asal->nama_kota }}</td>
                                <td>{{ $r->kota_tujuan->nama_kota }}</td>
                                <td>{{ $r->harga }}</td>
                                <td>
                                    
                                    <a href="/rute/edit/{{ $r->id_rute }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                    <a href="/rute/delete/{{ $r->id_rute }}" class="btn btn-lg"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          <!-- </div> -->
        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection