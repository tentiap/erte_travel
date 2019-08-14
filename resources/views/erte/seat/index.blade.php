@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Data Seat
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../seat">Seat</a></li>
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
                <a href="/seat/create" class="btn btn-primary">Tambah Seat</a>
              </div>

            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Posisi</th>
                        <th>OPSI</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach($seat as $s)
                            <tr>
                                <td>{{ $s->id_seat }}</td>
                                <td>{{ $s->posisi }}</td>
                                <td>
                                    
                                    <a href="/seat/edit/{{ $s->id_seat }}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                    <a href="/seat/delete/{{ $s->id_seat }}" class="btn btn-lg"><i class="fa fa-trash"></i></a>
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