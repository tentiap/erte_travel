<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = "id_users";
    protected $fillable = [
    		'id_users', 
    		'role', 
    		'username', 
    		'password', 
    		'email', 
    		'nama', 
    		'kontak', 
    		'jenis_kelamin'];

    
    protected $hidden = [
        'password', 'remember_token',
    ];
            
    public $incrementing = false;


    public function sopir()
    {
        return $this->hasOne(Sopir::class, 'id_users');
    }

    public function feeder()
    {
        return $this->hasOne(Feeder::class, 'id_users');
    }

    public function operator()
    {
        return $this->hasOne(Operator::class, 'id_users');
    }

    public function pemesan()
    {
        return $this->hasOne(Pemesan::class, 'id_users');
    }
}
