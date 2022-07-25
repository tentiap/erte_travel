<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKeyTrait;

class Seat extends Model {
    use CompositeKeyTrait;
    protected $table = "seat";
    protected $fillable = [
        'id_seat', 
        'keterangan'
    ];

    public $incrementing = false;

    protected $primaryKey = ['id_seat'];

   public function detail_pesanan() {
        return $this->hasMany(Detail_Pesanan::class);
   }
}
