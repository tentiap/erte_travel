<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeder extends Model
{
    protected $table = "feeder";
    protected $fillable = [
        'id_feeder', 
        'id_kota',
        'username',
        'email',
        'password',
        'nama',
        'kontak',
        'jenis_kelamin'
    ];
    protected $primaryKey = "id_feeder";

    public $incrementing = false;

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = \Hash::make($password);
    }

    public function kota() {
        return $this->belongsTo(Kota::class, 'id_kota');
    }

    public function detail_pesanan() {
        return $this->hasMany(detail_pesanan::class);
    }
}
