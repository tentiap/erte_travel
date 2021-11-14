<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKeyTrait;

class Pesanan extends Model
{
    use CompositeKeyTrait;
    protected $table = "pesanan";
    protected $fillable = [
        'id_pesanan',
        'id_trip', 
        'id_users_pemesan', 
        'tanggal_pesan',
        'id_users_operator',
        'jumlah_penumpang',
        'created_at'
    ];
    
    protected $primaryKey = ['id_pesanan', 'id_trip'];

    public function detail_pesanan()
    {   
        return $this->hasMany(Detail_Pesanan::class);      
    }

    public function pemesan()
    {
        return $this->belongsTo(Pemesan::class, 'id_users_pemesan');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id_trip');
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'id_users_operator');
    }

    
}
