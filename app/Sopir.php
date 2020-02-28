<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sopir extends Model
{
    protected $table = "sopir";
    protected $fillable = [
        'id_users',
        'plat_mobil', 
        'merek_mobil',
        'username',
        'email',
        'password',
        'nama',
        'kontak',
        'jenis_kelamin'
    ];

    protected $primaryKey = "id_users";
    public $incrementing = false;

    public function trip(){
        return $this->hasMany(Trip::class);
    }
	
}
