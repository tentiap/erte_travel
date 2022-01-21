<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model {
    protected $table = 'kota';
    protected $primaryKey = 'id_kota';
    
    protected $fillable = [
        'id_kota', 
        'nama_kota' 
    ];

    public $incrementing = false;

    public function rute() {
        return $this->hasMany(Rute::class);
    }

    public function pengurus() {
        return $this->hasMany(Pengurus::class);
    }

    public function feeder() {
        return $this->hasMany(Feeder::class);
    }
}
