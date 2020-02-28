<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    protected $table = "pemesan";
    protected $fillable = [
        'id_users',
        'username',
        'email',
        'password',
        'nama',
        'kontak',
        'jenis_kelamin' 
        'alamat',
    ];

    protected $primaryKey = "id_users";
    public $incrementing = false;

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }


}
