<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trip extends Model
{
    protected $table = "trip";
    protected $fillable = [
        'id_trip', 
        'id_users_operator',
	    'id_users_sopir', 
	    'id_kota_asal',
        'id_kota_tujuan',
	    'jadwal',
        'seat'
	];

    protected $primaryKey = "id_trip";
    public $incrementing = false;
    
    public function sopir()
    {
        return $this->belongsTo(Sopir::class, 'id_users_sopir');
    }

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_kota_asal', 'id_kota_tujuan');
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'id_users_operator');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
