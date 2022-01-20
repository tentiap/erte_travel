<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model {
    protected $table = "mobil";
    protected $fillable = [
        'plat_mobil',
        'id_sopir',
        'merek_mobil'
    ];

    protected $primaryKey = "plat_mobil";

    public function trip() {
        return $this->hasMany(Trip::class);
    }

    public function seat() {
        return $this->hasMany(Seat::class);
    }

    public function sopir() {
        return $this->belongsTo(Sopir::class, 'id_sopir');
    }
}