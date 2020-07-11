<?php

namespace App\Exports;

use App\Rute;
use Maatwebsite\Excel\Concerns\FromCollection;

class RuteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Rute::all();
    }
}
