@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Data Pesanan {{$pesanan->id_pesanan}}
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/pesanan">Pesanan</a></li>
            <li class="active">Edit Pesanan</li>
          </ol>
  </section>
 @endsection

@section('content') 
    <section class="content">
      <div class="box">
        <div class="box-body">
          <!-- <div class="box"> -->
              @include('messages')

            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Trip</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                  <!-- /.box-header -->
                <div class="box-body">
                        @if($pesanan->trip->id_kota_asal == "K1")
                                Bukittinggi
                        @elseif($pesanan->trip->id_kota_asal == "K2")
                                          Padang
                        @elseif($pesanan->trip->id_kota_asal == "K3")
                                          Payakumbuh
                        @endif

                        -  

                        @if($pesanan->trip->id_kota_tujuan == "K1")
                                Bukittinggi
                        @elseif($pesanan->trip->id_kota_tujuan == "K2")
                                Padang
                        @elseif($pesanan->trip->id_kota_tujuan == "K3")
                                Payakumbuh
                        @endif

                        
                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{ date('D, d M Y', strtotime($pesanan->trip->jadwal)) }}

                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{ date('H:i', strtotime($pesanan->trip->jadwal)) }}

                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{$jumlah}} penumpang


                        <a href="" data-toggle='modal' data-target='#edit_pesanan' style="position: absolute; top: 50px;right: 16px;"><i class="fa fa-edit"></i> Ubah</a>

                </div>

            </div>

            
                    <form method="post" action="/pesanan/update/{{$pesanan->id_pesanan}}/{{$pesanan->trip->id_trip}}">

                        @foreach($detail as $detail)

                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                            <div class="box box-default collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Detail Penumpang di seat {{$detail->id_seat}}  </h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Nama</label>
                                                <input type="text" name="nama_penumpang[]" class="form-control" placeholder="Nama" value="{{old('nama_penumpang', $detail->nama_penumpang)}}">

                                                    @if($errors->has('nama_penumpang'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('nama_penumpang')}}
                                                        </div>
                                                    @endif
                                            </div>

                                            <div class="col-sm-3">
                                                <label>Seat</label>
                                                <select class="form-control" name="id_seat[]" id="id_kota_asal">
                                                    <option value="">  Seat  </option>
                                                        @foreach($seat as $s)                                                               
                                                                <option value="{{$s->id_seat}}" {{$detail->id_seat == $s->id_seat ? 'selected' : ''}}>
                                                                    {{$s->id_seat}}
                                                                </option>
                                                        @endforeach 
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label>Jenis Kelamin</label>
                                                <select class="form-control" name="jenis_kelamin[]">
                                                    <option value=""> Jenis Kelamin  </option>
                                                        <option value="1" {{$detail->jenis_kelamin == 1 ? 'selected' : ''}}>
                                                            Laki-laki
                                                        </option>

                                                        <option value="2" {{$detail->jenis_kelamin == 2 ? 'selected' : ''}}>
                                                            Perempuan
                                                        </option>  
                                                       
                                                </select>
                                                <!-- <br>
                                                    <label class = "radio-inline">
                                                        <input type="radio" name="jenis_kelamin[]" value="1"> Laki-laki
                                                    </label>
                                                    <label class = "radio-inline"> 
                                                        <input type="radio" name="jenis_kelamin[]" value="2"> Perempuan 
                                                    </label>
 -->
                                                @if($errors->has('jenis_kelamin'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('jenis_kelamin')}}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Detail Asal</label>
                                                <textarea name="detail_asal[]" class="form-control" placeholder="Alamat asal penumpang">{{old('detail_asal', $detail->detail_asal)}}</textarea> 

                                                    @if($errors->has('detail_asal'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('detail_asal')}}
                                                        </div>
                                                    @endif
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Detail Tujuan</label>
                                                <textarea name="detail_tujuan[]" class="form-control" placeholder="Alamat tujuan penumpang">{{old('detail_tujuan', $detail->detail_tujuan)}}</textarea> 

                                                    @if($errors->has('detail_tujuan'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('detail_tujuan')}}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Nomor HP</label>
                                                <input type="text" name="no_hp[]" class="form-control" placeholder="Nomor HP jika berbeda dengan pemesan" value="{{old('no_hp', $detail->no_hp)}}">

                                                    @if($errors->has('no_hp'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('no_hp')}}
                                                        </div>
                                                    @endif
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Biaya Tambahan</label>
                                                <input type="number" name="biaya_tambahan[]" class="form-control" placeholder="Biaya Tambahan" value="{{old('biaya_tambahan', $detail->biaya_tambahan)}}">

                                                    @if($errors->has('biaya_tambahan'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('biaya_tambahan')}}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>



                                  </div>
                                <!-- <div class="box-body"> -->
                            </div>
                        <!-- /.box -->
                            @endforeach



                                <div class="form-group">
                                    <input type="submit" class="btn btn-info" value="Simpan">
                                    <!-- <button class="btn btn-default btn-close"><a href="/seat">Cancel</a></button> -->
                                    <a class="btn btn-default btn-close" href="/pesanan">Cancel</a>
                                </div>
                    </form>
                        
                </div>
        <!-- Jangan -->                                               
            </div> 

            <div class="modal fade" id="edit_pesanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                            <!-- Awal Modal Body -->
                                                    <b>Anda yakin ingin menghapus data pesanan ini ?</b><br><br>
                                                    <a class="btn btn-danger btn-ok"> Hapus</a>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                                            <!-- Akhir Modal body -->        
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                                    <script type="text/javascript">
                                      //Hapus Data
                                      $(document).ready(function() {
                                          $('#edit_pesanan').on('show.bs.modal', function(e) {
                                              $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                                          });
                                      });
                                    </script>

        </div>
           
        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection