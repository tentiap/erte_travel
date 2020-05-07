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
	    'jadwal'
	];

    protected $primaryKey = "id_trip";
    public $incrementing = false;

    // protected $casts = [
    //     'jadwal' => 'datetime',
    // ];

    // public function getJadwalAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d F Y H:i');
    // }

    // public function setJadwalAttribute($value)
    // {
    //     $this->attributes['jadwal'] = Carbon::parse($value);
    // }

    // protected $dates = ['jadwal'];
    // protected $dateFormat = 'YYYY-MM-DD HH:mm';
    // protected $dateFormat = 'Y-m-d H:i';
    
    public function sopir()
    {
        return $this->belongsTo(Sopir::class, 'id_users_sopir');
    }

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_kota_asal', 'id_kota_tujuan');
    }

    // public function kota_asal()
    // {
    //     return $this->belongsTo(Rute::class, 'id_kota_asal');
    // }

    // public function kota_tujuan()
    // {
    //     return $this->belongsTo(Rute::class, 'id_kota_tujuan');
    // }

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'id_users_operator');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
