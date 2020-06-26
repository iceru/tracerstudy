<?php

namespace App\Exports;

use App\Prodi;
use App\Fakultas;
use App\HistoryPekerjaan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class PekerjaanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $jabatan = DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi' )
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select('mahasiswa.nama_mhs', 'alumni.no_hp', 'alumni.email', 'perusahaan.nama_perusahaan', 'jabatan.nama_jabatan', 'program_studi.nama_prodi', 'fakultas.nama_fakultas', DB::raw("YEAR(tgl_yudisium) AS lulus"));

        if(request('fakultas')) {
            $data = $jabatan->where('nama_fakultas', '=', request('fakultas'))->get();
        }

        if(request('prodi')) {
            $data = $jabatan->where('nama_prodi', '=', request('prodi'))->get();
        }

        if(request('lulusan')) {
            $data = $jabatan->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
        }

        else {
            $data = $jabatan->get();
        }

        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();

        return $data;
    }
}
