<?php

namespace App\Http\Controllers;

use App\Prodi;
use App\Fakultas;
use App\Exports\JarakExport;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\DB;

class LaporanJarakController extends Controller
{

    public function haversine() {
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
                $fakultasNama = request('fakultas');
            }

            else {
                $fakultasNama = 'Fakultas';
            }

            if(request('prodi')) {
                $data = $alumni->where('nama_prodi', '=', request('prodi'))->get();
                $prdName = request('prodi');
            }

            else {
                $prdName = 'Program Studi';
            }

            if(request('lulusan')) {
                $data = $alumni->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
                $llsName = request('lulusan');
            }

            else {
                $data = $alumni->get();
                $llsName = 'Tahun Lulusan';
            }

            $prodi = Prodi::all();
            $fakultas = Fakultas::all();
            $lulusan = DB::table("mahasiswa")
                    ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                    ->orderBy('tgl_yudisium')
                    ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                    ->get();


            return view ('laporan.jarak', compact('data', 'prodi', 'fakultas', 'lulusan', 'prdName', 'fakultasNama', 'llsName'));
    }

    public function showJarak($id) {
        $jarak = DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select('mahasiswa.nama_mhs', 'alumni.id', 'perusahaan.alamat_perusahaan', 'perusahaan.nama_perusahaan', 'perusahaan.longitude', 'perusahaan.latitude')
        ->where('alumni.id', $id)
        ->get();

        return view ('laporan.detailJarak', ['jarak'=> $jarak]);
    }

    public function export()
    {
        return Excel::download(new JarakExport, 'jarak.xlsx');
    }

}
