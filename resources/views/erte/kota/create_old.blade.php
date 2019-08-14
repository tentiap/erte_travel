<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title>ERTE TOUR AND TRAVEL</title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                     <strong>TAMBAH DATA KOTA</strong> 
                </div>
                <div class="card-body">
                    <a href="/kota" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    
                    <form method="post" action="/kota/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id_kota" class="form-control" placeholder="ID kota ..">

                            @if($errors->has('id_kota'))
                                <div class="text-danger">
                                    {{ $errors->first('id_kota')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <textarea name="nama_kota" class="form-control" placeholder="Nama kota .."></textarea>

                             @if($errors->has('nama_kota'))
                                <div class="text-danger">
                                    {{ $errors->first('nama_kota')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>
</html>
