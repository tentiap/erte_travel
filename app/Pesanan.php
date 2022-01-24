<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKeyTrait;

class Pesanan extends Model {
    use CompositeKeyTrait;
    protected $table = "pesanan";
    protected $fillable = [
        'id_pemesan',
        'jadwal', 
        'plat_mobil', 
        'id_pengurus',
        'tanggal_pesan',
        'jumlah_penumpang'
    ];
    
    protected $primaryKey = ['id_pemesan', 'jadwal', 'plat_mobil'];
    public $incrementing = false;

    public function detail_pesanan() {
        return $this->hasMany(Detail_Pesanan::class);      
    }

    public function pemesan() {
        return $this->belongsTo(Pemesan::class, 'id_pemesan');
    }

    // public function trip() {
    //     return $this->compositeBelongsTo(Trip::class, ['jadwal', 'plat_mobil'], ['jadwal', 'plat_mobil']);
    // }

    public function trip() {
        return $this->belongsTo(Trip::class, 'jadwal', 'plat_mobil');
    }

    public function pengurus() {
        return $this->belongsTo(Pengurus::class, 'id_pengurus');
    }
}
