@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Data Trip
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/trip">Trip</a></li>
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
                <a href="/trip/create" class="btn btn-primary">Tambah Trip</a>
              </div>

              
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped" id="sortdata">
                  <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Plat Mobil</th>
                        <th>Kota Asal</th>
                        <th>Kota Tujuan</th>
                        <th>Tarif</th>
                        <th>OPSI</th>
                      </tr>
                  </thead>

                  <tbody>
                    @foreach($trip as $t)
                        <tr>
                            <td>{{ date('d-M-Y', strtotime($t->jadwal)) }} </td>
                            <td>{{ date('H:i', strtotime($t->jadwal)) }} </td>
                            <td>{{ $t->plat_mobil }}</td>
                            <td>
                                  
                                      @if($t->id_kota_asal == "K1")
                                          Bukittinggi
                                      @elseif($t->id_kota_asal == "K2")
                                          Padang
                                      @elseif($t->id_kota_asal == "K3")
                                          Pekanbaru
                                      @endif
                                  
                            </td>        
                            <td>
                                      @if($t->id_kota_tujuan == "K1")
                                          Bukittinggi
                                      @elseif($t->id_kota_tujuan == "K2")
                                          Padang
                                      @elseif($t->id_kota_tujuan == "K3")
                                          Pekanbaru
                                      @endif
                            </td>
                            <!-- <td>
                                    @if(empty($t->id_users_sopir))
                                      <a href="/trip/edit/{{ $t->id_trip }}"><u>Tambah Sopir</u></a>
                                    @else
                                      {{ $t->sopir->nama }}
                                    @endif
                            </td> -->
                            <td>@currency($t->tarif_trip)</td>                   
                            <td>        
                                <a href="/trip/show/{{ $t->jadwal }}/{{ $t->plat_mobil}}" class="btn btn-lg"><i class="fa fa-eye"></i></a>

                                <a href="/trip/edit/{{ $t->jadwal }}/{{ $t->plat_mobil}}" class="btn btn-lg"><i class="fa fa-edit"></i></a>

                                <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/trip/delete/{{ $t->jadwal }}/{{ $t->plat_mobil}}"><i class="fa fa-trash"></i></a>
                            </td>
                            </tr>
                                    <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <b>Anda yakin ingin menghapus data trip ini ?</b><br><br>
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
      
                  @endforeach
                </tbody>
              </table>
            </div>

            {{ $trip->links() }}

        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection