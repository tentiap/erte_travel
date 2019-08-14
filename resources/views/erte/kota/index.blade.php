@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Data Kota
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../kota">Kota</a></li>
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
                <a href="/kota/create" class="btn btn-primary">Tambah Kota</a>
              </div>

            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>OPSI</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach($kota as $k)
                            <tr>
                                <td>{{ $k->id_kota }}</td>
                                <td>{{ $k->nama_kota }}</td>
                                <td>
                                    
                                    <a href="/kota/edit/{{ $k->id_kota }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                    <a href="/kota/delete/{{ $k->id_kota }}" class="btn btn-lg"><i class="fa fa-trash"></i></a>
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