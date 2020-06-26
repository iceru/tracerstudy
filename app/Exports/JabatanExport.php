<?php

namespace App\Exports;

use App\HistoryPekerjaan;
use Maatwebsite\Excel\Concerns\FromCollection;

class JabatanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HistoryPekerjaan::all();
    }
}
