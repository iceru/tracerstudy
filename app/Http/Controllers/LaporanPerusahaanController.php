<?php

namespace App\Http\Controllers;

use App\Prodi;
use App\Fakultas;
use App\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPerusahaanController extends Controller
{

    public function indexChartPerusahaan() {
        $perusahaan =  DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi' )
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select(DB::raw("COUNT(perusahaan.nama_perusahaan) as countPerusahaan"), 'perusahaan.nama_perusahaan', 'perusahaan.alamat_perusahaan', 'perusahaan.id')
        ->groupBy('perusahaan.nama_perusahaan', 'perusahaan.alamat_perusahaan', 'perusahaan.id');

        if(request('fakultas')) {
            $data = $perusahaan->where('nama_fakultas', '=', request('fakultas'))->get();
            $fakultasNama = request('fakultas');
        }

        else {
            $fakultasNama = 'Fakultas';
        }

        if(request('prodi')) {
            $data = $perusahaan->where('nama_prodi', '=', request('prodi'))->get();
            $prdName = request('prodi');
        }

        else {
            $prdName = 'Program Studi';
        }

        if(request('lulusan')) {
            $data = $perusahaan->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
            $llsName = request('lulusan');
        }

        else {
            $data = $perusahaan->get();
            $llsName = 'Tahun Lulusan';
        }

        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();

        return view('laporan.chartPerusahaan', compact('data',  'prodi', 'fakultas', 'lulusan', 'prdName', 'fakultasNama', 'llsName'));
    }

    public function showPerusahaan ($id) {
        $perusahaanNama = Perusahaan::where('id', $id)->first();
        $perusahaan =  DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select('perusahaan.nama_perusahaan', 'perusahaan.alamat_perusahaan', 'mahasiswa.nama_mhs', 'alumni.no_hp', 'alumni.email')
        ->where('perusahaan.id', $id)
        ->get();
        return view ('laporan.detailPerusahaan', ['perusahaan'=> $perusahaan, 'perusahaanNama' => $perusahaanNama ]);
    }

    public function chartPerusahaan() {
        $perusahaan =  DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select(DB::raw("COUNT(perusahaan.nama_perusahaan) as countPerusahaan"), 'perusahaan.nama_perusahaan')
        ->groupBy('perusahaan.nama_perusahaan')
        ->get();

        return response()->json($perusahaan);

    }

}
