<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model {
    protected $table = "pemesan";
    protected $fillable = [
        'id_pemesan',
        'username',
        'email',
        'password',
        'nama',
        'kontak',
        'jenis_kelamin', 
        'alamat'
    ];

    protected $primaryKey = "id_pemesan";

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = \Hash::make($password);
    }

    public function pesanan() {
        return $this->hasMany(Pesanan::class);
    }
}
