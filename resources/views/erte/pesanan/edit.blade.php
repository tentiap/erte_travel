@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          <!-- Edit Data Pesanan {{$id}} -->
          Edit Data Pesanan 
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
                        @if($trip->id_kota_asal == "K1")
                                Bukittinggi
                        @elseif($trip->id_kota_asal == "K2")
                                Padang
                        @elseif($trip->id_kota_asal == "K3")
                                Pekanbaru
                        @endif

                        -  

                        @if($trip->id_kota_tujuan == "K1")
                                Bukittinggi
                        @elseif($trip->id_kota_tujuan == "K2")
                                Padang
                        @elseif($trip->id_kota_tujuan == "K3")
                                Pekanbaru
                        @endif

                        
                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{ date('D, d M Y', strtotime($pesanan->jadwal)) }}

                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{ date('H:i', strtotime($pesanan->jadwal)) }}

                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{$jumlah}} penumpang


                        <!-- <a href="/pesanan/update_create/{{ $pesanan->id_pesanan}}/{{$pesanan->id_trip}}" style="position: absolute; top: 50px;right: 16px;"><i class="fa fa-edit"></i> Ubah</a> -->

                </div>

            </div>

                    <form method="post" action="/pesanan/update/{{$pesanan->id_pemesan}}/{{$pesanan->jadwal}}/{{$pesanan->plat_mobil}}">

                        @foreach($detail as $detail)

                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                            <div class="box box-default collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Detail Penumpang di seat {{$detail->id_seat}}  </h3>
                                    <small>
                                        Seat yang sudah diisi : 
                                            @foreach($seat_b as $sb)
                                                @if(empty($sb->id_seat))
                                                  <p>Belum ada</p>
                                                @else
                                                  {{$sb->id_seat}},
                                                @endif                                               
                                            @endforeach      
                                    </small>

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

                                            <div class="col-sm-6">
                                                <label>Jenis Kelamin</label>
                                                <select class="form-control" name="jenis_kelamin[]">
                                                    <option value=""> Jenis Kelamin  </option>
                                                        <option value="Laki-laki" {{$detail->jenis_kelamin == "Laki-laki" ? 'selected' : ''}}>
                                                            Laki-laki
                                                        </option>

                                                        <option value="Perempuan" {{$detail->jenis_kelamin == "Perempuan" ? 'selected' : ''}}>
                                                            Perempuan
                                                        </option>  
                                                       
                                                </select>
                                               
                                                @if($errors->has('jenis_kelamin'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('jenis_kelamin')}}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Seat</label>
                                                <select class="form-control" name="id_seat[]">
                                                    <option value="{{ $detail->id_seat}}">
                                                    {{$detail->id_seat}}
                                                    </option> 
                                                </select>

                                                @if($errors->has('id_seat'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('id_seat')}}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Feeder</label>
                                                <select class="form-control" name="id_feeder[]">
                                                    <option value="">  Belum ada feeder  </option>
                                                        @foreach($feeder as $f)                                                               
                                                                <option value="{{$f->id_feeder}}" {{$detail->id_feeder == $f->id_feeder ? 'selected' : ''}}>
                                                                    {{$f->nama}}
                                                                </option>
                                                        @endforeach 
                                                </select>
                                            </div>

                                            <!-- <div class="col-sm-6">
                                                <label>Order Number</label>
                                                <select class="form-control" name="order_number[]">
                                                    <option value="{{ $detail->order_number}}">
                                                    {{$detail->order_number}}
                                                    </option> 
                                                </select>
                                            </div> -->
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
                                            <div class="col-sm-3">
                                                <label>Nomor HP</label>
                                                <input type="text" name="no_hp[]" class="form-control" placeholder="Nomor HP jika berbeda dengan pemesan" value="{{old('no_hp', $detail->no_hp)}}">

                                                    @if($errors->has('no_hp'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('no_hp')}}
                                                        </div>
                                                    @endif
                                            </div>

                                            <!-- <div class="col-sm-3">
                                                <label>Feeder</label>
                                                <select class="form-control" name="id_feeder[]">
                                                    <option value="">  Belum ada feeder  </option>
                                                        @foreach($feeder as $f)                                                               
                                                                <option value="{{$f->id_feeder}}" {{$detail->id_feeder == $f->id_feeder ? 'selected' : ''}}>
                                                                    {{$f->nama}}
                                                                </option>
                                                        @endforeach 
                                                </select>
                                            </div> -->

                                            <div class="col-sm-3">
                                                <label>Biaya Tambahan</label>
                                                <input type="number" name="biaya_tambahan[]" class="form-control" placeholder="Biaya Tambahan" value="{{old('biaya_tambahan', $detail->biaya_tambahan)}}">

                                                    @if($errors->has('biaya_tambahan'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('biaya_tambahan')}}
                                                        </div>
                                                    @endif
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Status</label>
                                                <select class="form-control" name="status[]" id="status">
                                                    <option disabled selected value>  -----Status-----  </option>
                                                        <option value="1" {{$detail->status == 1 ? 'selected' : ''}}>
                                                                    Booking
                                                        </option>

                                                        <option value="2" {{$detail->status == 2 ? 'selected' : ''}}>
                                                                    Picked Up
                                                        </option>

                                                        <option value="3" {{$detail->status == 3 ? 'selected' : ''}}>
                                                                    On Going
                                                        </option>

                                                        <option value="4" {{$detail->status == 4 ? 'selected' : ''}}>
                                                                    Arrived
                                                        </option>

                                                        <option value="5" {{$detail->status == 5 ? 'selected' : ''}}>
                                                                    Cancelled
                                                        </option>
                                                </select>
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

            <div class="modal fade" id="ubah_pesanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- Awal Modal Body -->
                            <b>Ubah Pesanan</b><br><br>
                                <form method="post" action="/pesanan/update1/{{$pesanan->id_pemesan}}/{{$pesanan->jadwal}}/{{$pesanan->plat_mobil}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                        <label>Kota Asal</label>
                                                        <select class="form-control" name="id_kota_asal" id="id_kota_asal">
                                                            <option disabled selected value> -- Kota Asal -- </option>
                                                                @foreach($kota as $k)
                                                                        <option value="{{ $k->id_kota }}" {{$pesanan->id_kota_asal == $k->id_kota ? 'selected' : ''}}>
                                                                        {{$k->nama_kota}}
                                                                        </option>
                                                                @endforeach 
                                                        </select>

                                                        @if($errors->has('id_kota_asal'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('id_kota_asal')}}
                                                            </div>
                                                        @endif
                                                </div>

                                                <div class="col-sm-6">
                                                        <label>Kota Tujuan</label>
                                                        <select class="form-control" name="id_kota_tujuan" id="id_kota_tujuan">
                                                            <option disabled selected value> -- Kota Tujuan -- </option>
                                                            @foreach($kota as $k)
                                                                        <option value="{{ $k->id_kota }}" {{$trip->id_kota_asal == $k->id_kota ? 'selected' : ''}}>
                                                                        {{$k->nama_kota}}
                                                                        </option>
                                                            @endforeach                                                            
                                                        </select>

                                                        @if($errors->has('id_kota_tujuan'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('id_kota_tujuan')}}
                                                            </div>
                                                        @endif
                                                </div>                                                
                                            </div>


                                                <label>Jadwal</label>
                                                    <div class='input-group date' id='date'>
                                                        <input type='text' class="form-control" name="tanggal" value="{{ $pesanan->jadwal }}" />
                                                              <span class="input-group-addon">
                                                                  <span class="glyphicon glyphicon-calendar"></span>
                                                              </span>
                                                        @if($errors->has('tanggal'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('tanggal')}}
                                                            </div>
                                                        @endif      
                                                    </div>

                                                
                                            </div>
                                                
                                            <!-- <div class="col-sm-6"> -->
                                                <label>Jumlah penumpang</label>
                                                    <select class="form-control" name="jumlah_penumpang">
                                                        <option disabled selected value> -- Jumlah Penumpang -- </option>
                                                            @foreach($seat as $s)
                                                                    <option value="{{ $s->id_seat }}" {{$jumlah == $s->id_seat ? 'selected' : ''}}>
                                                                    {{$s->id_seat}}
                                                                    </option> 
                                                            @endforeach 
                                                        @if($errors->has('jumlah_penumpang'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('jumlah_penumpang')}}
                                                            </div>
                                                        @endif            
                                                            
                                                    </select>
                                                             
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary" value="Cari">
                                                    </div>                     
                                </form>                
                            <!-- Akhir Modal body -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                <script type="text/javascript">
                    //Hapus Data
                    $(document).ready(function() {
                        $('#edit_pesanan').on('show.bs.modal', function(e) {
                            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                        });
                    });
                </script>
 -->
        </div>
           
        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection