<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengurus extends Authenticatable {
    use Notifiable;

    protected $guard = 'pengurus';
    protected $table = "pengurus";
    protected $fillable = [
        'id_pengurus', 
        'id_kota',
        'username',
        'email',
        'password',
        'nama',
        'kontak',
        'jenis_kelamin'
    ];

    protected $primaryKey = "id_pengurus";
    public $incrementing = false;

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = \Hash::make($password);
    }

    public function pesanan() {
        return $this->hasMany(Pesanan::class);
    }

    public function kota() {
        return $this->belongsTo(Kota::class, 'id_kota');
    }
}