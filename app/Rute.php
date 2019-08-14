<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    protected $table = "rute";
    protected $primaryKey = 'id_rute';
    protected $fillable = ['id_rute', 'id_kota_tujuan', 'id_kota_asal', 'harga'];
     public $incrementing = false;


    public function trip()
    {
        return $this->hasMany(Trip::class);
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'id_kota_asal');
    }

    // public function kota_tujuan()
    // {
    //     return $this->belongsTo(Kota::class, 'id_kota_tujuan');
    // }
}
