<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKeyTrait;

class Rute extends Model {
    use CompositeKeyTrait;
    protected $table = "rute";
    protected $primaryKey = ['id_kota_asal', 'id_kota_tujuan'];
    protected $fillable = [
        'id_kota_asal', 
        'id_kota_tujuan', 
        'tarif'
    ];
    public $incrementing = false;

    public function trip() {
        return $this->hasMany(Trip::class);
    }

    public function kota_asal() {
        return $this->belongsTo(Kota::class, 'id_kota_asal');
    }

    public function kota_tujuan() {
        return $this->belongsTo(Kota::class, 'id_kota_tujuan');
    }

}