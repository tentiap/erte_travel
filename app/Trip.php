<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKeyTrait;

class Trip extends Model {
    use CompositeKeyTrait;
    protected $table = "trip";
    protected $fillable = [ 
        'jadwal',
        'plat_mobil', 
	    'id_kota_asal',
        'id_kota_tujuan',
        'tarif_trip'
	];

    protected $primaryKey = ['jadwal', 'plat_mobil'];
    public $incrementing = false;
    
    public function mobil() {
        return $this->belongsTo(Mobil::class, 'plat_mobil');
    }

    public function rute() {
        return $this->belongsTo(Rute::class, 'id_kota_asal', 'id_kota_tujuan');
    }

    public function pesanan() {
        return $this->hasMany(Pesanan::class);
    }
}
