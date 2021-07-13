@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Cetak Laporan 
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/report">Report</a></li>
            <li class="active">Index</li>
          </ol>
  </section>
 @endsection

@section('content') 
    <section class="content">
      <div class="box">
        <div class="box-body">
          <!-- <div class="box"> -->
              @include('messages')
              <div class="box-header" align="right">                
                <a href="/pesanan/create" class="btn btn-primary">Tambah Pesanan</a>
              </div>

              

            <div class="box-body">
                <table id="sortdata" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Pemesan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Kota Asal</th>
                        <th>Kota Tujuan</th>
                        <th>Tanggal Pesan</th>
                        <th>Operator</th>
                        <th>OPSI</th>
                      </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>

        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection