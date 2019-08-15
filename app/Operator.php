<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $table = "operator";
    protected $fillable = ['id_users', 'id_kota'];

    public function users()
    {
        return $this->belongsTo(Users::class, 'id_users');
    }

    public function trip()
    {
        return $this->hasMany(Trip::class);
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'id_kota');
    }
}
