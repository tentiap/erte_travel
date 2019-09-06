<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeder extends Model
{
    protected $table = "feeder";
    protected $fillable = ['id_users', 'id_kota'];
    protected $primaryKey = "id_users";
    public $incrementing = false;

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'id_kota');
    }

    public function trip()
    {
        return $this->hasMany(Trip::class);
    }

    public function users()
    {
        return $this->belongsTo(Users::class, 'id_users');
    }
}
