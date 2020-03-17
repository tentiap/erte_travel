<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $table = "operator";
    protected $fillable = [
        'id_users', 
        'id_kota',
        'username',
        'email',
        'password',
        'nama',
        'kontak',
        'jenis_kelamin'
    ];
    protected $primaryKey = "id_users";
    public $incrementing = false;

    // public function users()
    // {
    //     return $this->belongsTo(User::class, 'id_users');
    // }

    public function trip()
    {
        return $this->hasMany(Trip::class);
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'id_kota');
    }
}
