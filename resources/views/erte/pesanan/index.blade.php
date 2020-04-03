@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Data Pesanan
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/pesanan">Pesanan</a></li>
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
                        <th>ID Pesanan</th>
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
                  @foreach($pesanan as $p)
                      
                            <tr>
                                <td>{{ $p->id_pesanan }}</td>
                                <td>{{ $p->pemesan->nama }}</td>
                                <td>{{ date('d M Y', strtotime($p->trip->jadwal)) }} </td>
                                <td>{{ date('H:i', strtotime($p->trip->jadwal)) }} </td>
                                <!-- <td>{{ $p->trip->rute->kota_asal->nama_kota }}</td>
                                <td>{{ $p->trip->rute->kota_tujuan->nama_kota }}</td> -->
                                <td>
                                  
                                      @if($p->trip->id_kota_asal == "K1")
                                          Bukittinggi
                                      @elseif($p->trip->id_kota_asal == "K2")
                                          Padang
                                      @elseif($p->trip->id_kota_asal == "K3")
                                          Payakumbuh
                                      @endif
                                  
                                </td>        
                                <td>
                                      @if($p->trip->id_kota_tujuan == "K1")
                                          Bukittinggi
                                      @elseif($p->trip->id_kota_tujuan == "K2")
                                          Padang
                                      @elseif($p->trip->id_kota_tujuan == "K3")
                                          Payakumbuh
                                      @endif
                              </td>
                                <td>{{ date('d M Y H:i', strtotime($p->tanggal_pesan)) }} </td>
                                <td>{{ $p->operator->nama }}</td>          
                                                                     
                                
                                <td>
                                    
                                    <a href="/pesanan/show/{{ $p->id_pesanan, $p->id_trip, $p->id_users_pemesan }}" class="btn btn-lg"><i class="fa fa-eye"></i></a>


                                    <a href="/pesanan/edit/{{ $p->id_pesanan}}/{{ $p->id_trip}}/{{$p->id_users_pemesan}}" class="btn btn-lg"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-lg" data-toggle='modal' data-target='#konfirmasi_hapus' data-href="/pesanan/delete/{{ $p->id_pesanan}}/{{ $p->id_trip}}/{{$p->id_users_pemesan}}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>


                                    <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <b>Anda yakin ingin menghapus data pesanan ini ?</b><br><br>
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

        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection