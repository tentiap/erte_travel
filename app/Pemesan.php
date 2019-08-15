<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    protected $table = "pemesan";
    protected $fillable = ['id_users', 'alamat'];

    public function users()
    {
        return $this->belongsTo(Users::class, 'id_users');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }


}
