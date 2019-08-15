<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = "pesanan";
    protected $fillable = ['id_trip', 'id_users_pemesan', 'tanggal_pesan'];

    public function detail_pesanan()
    {
        return $this->hasMany(Detail_Pesanan::class);
    }

    public function pemesan()
    {
        return $this->belongsTo(Pemesan::class, 'id_users');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id_trip');
    }
}
