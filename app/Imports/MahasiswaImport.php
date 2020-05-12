<?php

namespace App\Imports;

use App\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class MahasiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mahasiswa([
            'NIM'   => $row['nim'],
            'nama_mhs' => $row['nama_mahasiswa'],
            'tgl_yudisium' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_yudisium']) ,
            'ipk' => $row['ipk'],
            'id_prodi' => $row['program_studi'],
        ]);
    }
}
