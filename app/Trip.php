<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table = "trip";
    protected $fillable = ['id_trip', 
    'id_users_operator',
	'id_users_sopir', 
	'id_users_feeder',
	'id_rute',
	'tanggal',
	'jam'];
    protected $primaryKey = "id_trip";
    public $incrementing = false;

    public function sopir()
    {
        return $this->belongsTo(Sopir::class, 'id_users_sopir');
    }

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_rute');
    }

    public function feeder()
    {
        return $this->belongsTo(Feeder::class, 'id_users_feeder');
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'id_users_operator');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
