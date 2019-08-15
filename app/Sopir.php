<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sopir extends Model
{
    protected $table = "sopir";
    protected $fillable = ['id_users', 'plat_mobil', 'merek_mobil'];

    public function users()
    {
        return $this->hasOne(Users::class, 'id_users');
    }

    public function trip()
    {
        return $this->hasMany(Trip::class);
    }

	
}
