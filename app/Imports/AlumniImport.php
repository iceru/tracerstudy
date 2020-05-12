<?php

namespace App\Imports;

use App\Alumni;
use Maatwebsite\Excel\Concerns\ToModel;

class AlumniImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Alumni([
            'NIM' => $row['nim'],
            'no_hp' => $row['no_hp'],
            'email' => $row['email'] ,
        ]);
    }
}
