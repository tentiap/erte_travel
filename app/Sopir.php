<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sopir extends Model
{
    protected $table = "sopir";
    protected $fillable = ['plat_mobil', 'merek_mobil'];
    protected $primaryKey = "id_users";
    public $incrementing = false;

    public function users()
    {
        // return $this->hasOne(Users::class, 'id_users');
         return $this->belongsTo(Users::class, 'id_users');
    }

    public function trip()
    {
        return $this->hasMany(Trip::class);
    }

	
}
