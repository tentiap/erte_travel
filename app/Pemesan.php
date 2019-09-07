<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    protected $table = "pemesan";
    protected $fillable = ['id_users', 'alamat'];
    protected $primaryKey = "id_users";
    public $incrementing = false;

    public function users()
    {
        return $this->belongsTo(Users::class, 'id_users');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }


}
