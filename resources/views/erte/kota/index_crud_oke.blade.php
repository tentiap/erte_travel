   
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
                    Data Kota
                </div>
                <div class="card-body">
                    <a href="/kota/create" class="btn btn-primary">Tambah Kota</a>
                    <br/>
                    <br/>
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
                                    <a href="/kota/edit/{{ $k->id_kota }}" class="btn btn-warning">Edit</a>
                                    <a href="/kota/delete/{{ $k->id_kota }}" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

