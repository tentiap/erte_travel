<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = [
    		'id_users', 
    		'role', 
    		'username', 
    		'password', 
    		'email', 
    		'nama', 
    		'kontak', 
    		'jenis_kelamin'];

    public function sopir()
    {
        return $this->hasOne(Sopir::class, 'id_users_sopir');
    }

    public function feeder()
    {
        return $this->hasOne(Feeder::class, 'id_users_feeder');
    }

    public function operator()
    {
        return $this->hasOne(Operator::class, 'id_users_operator');
    }

    public function pemesan()
    {
        return $this->hasOne(Pemesan::class, 'id_users_pemesan');
    }
}
