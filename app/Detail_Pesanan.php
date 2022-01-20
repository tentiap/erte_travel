<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKeyTrait;

class Detail_Pesanan extends Model {
    use CompositeKeyTrait;

    protected $table = "detail_pesanan";
    protected $fillable = [
        'jadwal',
        'plat_mobil',  
        'id_seat',
        'order_number',
        'id_pemesan',
        'id_feeder', 
        'nama_penumpang', 
        'jenis_kelamin', 
        'detail_asal', 
        'detail_tujuan',
        'no_hp',
        'status',
        'biaya_tambahan'
    ];

    protected $primaryKey = ['jadwal', 'plat_mobil', 'id_seat', 'order_number'];

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, ['id_pemesan', 'jadwal', 'plat_mobil']);
    }

    public function seat() {
        return $this->belongsTo(Seat::class, 'id_seat', 'plat_mobil');
    }

    public function feeder() {
        return $this->belongsTo(Feeder::class, 'id_feeder');
    }
}
