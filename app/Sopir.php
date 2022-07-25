<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sopir extends Model {
    protected $table = "sopir";
    protected $fillable = [
        'plat_mobil',
        'id_sopir',
        'username',
        'email',
        'password',
        'nama',
        'kontak',
        'jenis_kelamin'
    ];

    protected $primaryKey = "plat_mobil";
    public $incrementing = false;

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = \Hash::make($password);
    }

    public function mobil(){
        return $this->belongsTo(Mobil::class, 'plat_mobil');
    }
}
