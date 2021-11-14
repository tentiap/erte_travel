<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKeyTrait;

class Detail_Pesanan extends Model
{
    use CompositeKeyTrait;

    protected $table = "detail_pesanan";
    protected $fillable = [
        'id_detail_pesanan',
        'id_trip',  
        'id_seat',
        'id_users_feeder', 
        'nama_penumpang', 
        'jenis_kelamin', 
        'detail_asal', 
        'detail_tujuan',
        'no_hp',
        'status',
        'biaya_tambahan',
        'id_pesanan'
    ];
    protected $primaryKey = ['id_detail_pesanan'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, ['id_pesanan', 'id_trip'], ['id_pesanan', 'id_trip']);
    }

    public function seat()
    {
    return $this->belongsTo(Seat::class, 'id_seat');
    }

    public function feeder()
    {
        return $this->belongsTo(Feeder::class, 'id_users_feeder');
    }
}
