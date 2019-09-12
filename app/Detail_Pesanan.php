<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Pesanan extends Model
{
    protected $table = "detail_pesanan";
    protected $fillable = ['id_trip', 'id_users_pemesan', 'id_seat', 'nama_penumpang', 'jenis_kelamin', 'detail_asal', 'detail_tujuan'];
    protected $primaryKey = "id_trip, id_users_pemesan, id_seat";
    public $incrementing = false;

    public function seat()
    {
    return $this->belongsTo(Seat::class, 'id_seat');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_trip', 'id_users_pemesan');
    }
}
