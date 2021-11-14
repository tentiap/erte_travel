<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Operator extends Authenticatable
{
    use Notifiable;

    protected $guard = 'operator';
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

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
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
