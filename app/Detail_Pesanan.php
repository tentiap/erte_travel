<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKeyTrait;

class Detail_Pesanan extends Model {
    use CompositeKeyTrait;

    protected $table = "detail_pesanan";
    protected $fillable = [
        'id_pemesan',
        'jadwal',
        'plat_mobil',  
        'id_seat',
        // 'order_number',
        'id_feeder', 
        'nama_penumpang', 
        'jenis_kelamin', 
        'detail_asal', 
        'detail_tujuan',
        'no_hp',
        'status',
        'biaya_tambahan'
    ];

    public $incrementing = false;

    protected $primaryKey = ['id_pemesan', 'jadwal', 'plat_mobil', 'id_seat'];

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, ['id_pemesan', 'jadwal', 'plat_mobil']);
    }

    public function seat() {
        return $this->belongsTo(Seat::class, 'id_seat');
    }

    public function feeder() {
        return $this->belongsTo(Feeder::class, 'id_feeder');
    }
}
