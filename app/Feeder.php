<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeder extends Model
{
    protected $table = "feeder";
    protected $fillable = [
        'id_users', 
        'id_kota',
        'username',
        'email',
        'password',
        'nama',
        'kontak',
        'jenis_kelamin'
    ];
    protected $primaryKey = "id_users";
    public $incrementing = false;

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'id_kota');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function detail_pesanan()
    {
        return $this->hasMany(detail_pesanan::class);
    }

}
