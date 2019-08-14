<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $table = "seat";
    protected $primaryKey = 'id_seat';
    protected $fillable = [
    		'id_seat', 
    		'posisi'];
    public $incrementing = false;

   public function detail_pesanan()
    {
        return $this->hasMany(Detail_Pesanan::class);
    }

}
