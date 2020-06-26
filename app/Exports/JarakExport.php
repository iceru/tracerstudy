<?php

namespace App\Exports;

use App\Prodi;
use App\Fakultas;
use App\HistoryPekerjaan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class JarakExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $sqlDistance = DB::raw('( 100 * 111.045 * acos( cos( radians(-6.1694043) )
            * cos( radians( perusahaan.latitude ) )
            * cos( radians( perusahaan.longitude )
            - radians(106.7891015) )
            + sin( radians(-6.1694043) )
            * sin( radians( perusahaan.latitude ) ) ) )');

        $alumni =  DB::table('history_pekerjaan')
            ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
            ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
            ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi' )
            ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
            ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
            ->select('alumni.id', 'alumni.NIM', 'mahasiswa.nama_mhs', 'perusahaan.alamat_perusahaan',
                    'perusahaan.latitude', 'perusahaan.longitude',)
            ->selectRaw("{$sqlDistance} AS distance")
            ->orderBy('alumni.NIM');

            if(request('fakultas')) {
                $data = $alumni->where('nama_fakultas', '=', request('fakultas'))->get();
            }

            if(request('prodi')) {
                $data = $alumni->where('nama_prodi', '=', request('prodi'))->get();
            }

            if(request('lulusan')) {
                $data = $alumni->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
            }

            else {
                $data = $alumni->get();
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
