<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bukti Pesanan {{ $pesanan->id_pesanan }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-car"></i> PT Erte Tour & Travel
          <small class="pull-right">{{ date('d M Y H:i', strtotime($pesanan->tanggal_pesan)) }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Pemesan: {{ $pesanan->pemesan->nama }}</strong><br>
          Alamat: {{ $pesanan->pemesan->alamat }}<br>
          Kontak: {{ $pesanan->pemesan->kontak }}<br>
          Email: {{ $pesanan->pemesan->email }}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>ID Trip: {{ $trip->id_trip }}</strong><br>
          Rute:     @if($trip->id_kota_asal == "K1")
                        Bukittinggi
                    @elseif($trip->id_kota_asal == "K2")
                        Padang
                    @elseif($trip->id_kota_asal == "K3")
                        Pekanbaru
                    @endif - @if($trip->id_kota_tujuan == "K1")
                                          Bukittinggi
                                      @elseif($trip->id_kota_tujuan == "K2")
                                          Padang
                                      @elseif($trip->id_kota_tujuan == "K3")
                                          Pekanbaru
                                      @endif<br>
          Tanggal: {{ date('d M Y', strtotime($trip->jadwal)) }}<br>
          Jam: {{ date('H:i', strtotime($trip->jadwal)) }}<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>ID Pesanan: {{ $pesanan->id_pesanan }}</b><br>
        <b>Operator:</b> {{ $pesanan->operator->nama}}<br>
        <b>Kontak:</b> {{ $pesanan->operator->kontak}}<br>
        <b>Email:</b> {{ $pesanan->operator->email}}
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <br>
    <br>
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Nama Penumpang</th>
            <th>Jenis Kelamin</th>
            <th>Kontak</th>
            <th>Detail Asal</th>
            <th>Detail Tujuan</th>
            <th>Seat</th>
            <th>Harga</th>
          </tr>
          </thead>
          
          <tbody>
              @foreach($detail as $d)
                <tr>
                    <td>{{ $d->nama_penumpang }} </td>
                    <td>{{ $d->jenis_kelamin }} </td>
                    <td>
                          @if(empty($d->no_hp))
                                    -
                          @else
                              {{ $d->no_hp }} 
                          @endif    
                    </td>
                    <td>{{ $d->detail_asal }} </td>
                    <td>{{ $d->detail_tujuan }} </td>
                    <td>{{ $d->id_seat}}</td>
                    <td> @currency($trip->rute->harga) </td>
                    
                </tr>
            @endforeach                    
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        
      </div>
      <!-- /.col -->
      <div class="col-xs-6">

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th>Jumlah Penumpang</th>
              <td>{{ $jumlah }} orang</td>
            </tr>
            <!-- <tr>
              <th>Harga:</th>
              <td>@currency($trip->rute->harga)/pax</td>
            </tr> -->
            <tr>
              <th>Total:</th>
              <td><strong>@currency($trip->rute->harga * $jumlah) </strong></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>