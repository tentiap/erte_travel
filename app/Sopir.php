<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sopir extends Model {
    protected $table = "sopir";
    protected $fillable = [
        'id_sopir',
        'username',
        'email',
        'password',
        'nama',
        'kontak',
        'jenis_kelamin'
    ];

    protected $primaryKey = "id_sopir";
    public $incrementing = false;

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = \Hash::make($password);
    }

    public function mobil(){
        return $this->hasMany(Mobil::class);
    }
}
