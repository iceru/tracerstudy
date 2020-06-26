<?php

namespace App\Http\Controllers;

use Excel;
use App\Prodi;
use App\Jabatan;
use App\Fakultas;
use Illuminate\Http\Request;
use App\Exports\PekerjaanExport;
use Illuminate\Support\Facades\DB;

class LaporanJabatanController extends Controller
{

    public function jabatan() {
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
            $fakultasNama = request('fakultas');
        }

        else {
            $fakultasNama = 'Fakultas';
        }

        if(request('prodi')) {
            $data = $jabatan->where('nama_prodi', '=', request('prodi'))->get();
            $prdName = request('prodi');
        }

        else {
            $prdName = 'Program Studi';
        }

        if(request('lulusan')) {
            $data = $jabatan->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
            $llsName = request('lulusan');
        }

        else {
            $data = $jabatan->get();
            $llsName = 'Tahun Lulusan';
        }

        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();

        return view ('laporan.jabatan-perusahaan', compact('data', 'prodi', 'fakultas', 'lulusan', 'prdName', 'fakultasNama', 'llsName'));
    }

    public function export() {
        return Excel::download(new PekerjaanExport, 'pekerjaan-alumni.xlsx');
    }

    public function indexChartJabatan() {
        $jabatan =  DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi' )
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select(DB::raw("COUNT(jabatan.nama_jabatan) as countJabatan"), 'jabatan.nama_jabatan', 'jabatan.id')
        ->groupBy('jabatan.nama_jabatan', 'jabatan.id');

        if(request('fakultas')) {
            $data = $jabatan->where('nama_fakultas', '=', request('fakultas'))->get();
            $fakultasNama = request('fakultas');
        }

        else {
            $fakultasNama = 'Fakultas';
        }

        if(request('prodi')) {
            $data = $jabatan->where('nama_prodi', '=', request('prodi'))->get();
            $prdName = request('prodi');
        }

        else {
            $prdName = 'Program Studi';
        }

        if(request('lulusan')) {
            $data = $jabatan->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
            $llsName = request('lulusan');
        }

        else {
            $data = $jabatan->get();
            $llsName = 'Tahun Lulusan';
        }

        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();

        return view('laporan.chartJabatan', compact('data', 'prodi', 'fakultas', 'lulusan', 'prdName', 'fakultasNama', 'llsName'));
    }


    public function showJabatan ($id) {
        $jabatanNama = Jabatan::where('id', $id)->first();

        $jabatan =  DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi' )
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select('jabatan.nama_jabatan', 'mahasiswa.nama_mhs', 'alumni.no_hp', 'alumni.email', 'perusahaan.nama_perusahaan')
        ->where('jabatan.id', $id);

        if(request('fakultas')) {
            $data = $jabatan->where('nama_fakultas', '=', request('fakultas'))->get();
            $fakultasNama = request('fakultas');
        }

        else {
            $fakultasNama = 'Fakultas';
        }

        if(request('prodi')) {
            $data = $jabatan->where('nama_prodi', '=', request('prodi'))->get();
            $prdName = request('prodi');
        }

        else {
            $prdName = 'Program Studi';
        }

        if(request('lulusan')) {
            $data = $jabatan->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
            $llsName = request('lulusan');
        }

        else {
            $data = $jabatan->get();
            $llsName = 'Tahun Lulusan';
        }

        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();

        return view ('laporan.detailJabatan', compact('data', 'jabatanNama', 'prodi', 'fakultas', 'lulusan', 'prdName', 'fakultasNama', 'llsName'));
    }


    public function chartJabatan() {
        $chart =  DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi' )
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select(DB::raw("COUNT(jabatan.nama_jabatan) as countJabatan"), 'jabatan.nama_jabatan')
        ->groupBy('jabatan.nama_jabatan');

        if(request('fakultas')) {
            $jabatan = $chart->where('nama_fakultas', '=', request('fakultas'))->get();
        }

        if(request('prodi')) {
            $jabatan = $chart->where('nama_prodi', '=', request('prodi'))->get();
        }

        if(request('lulusan')) {
            $jabatan = $chart->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
        }

        else {
            $jabatan = $chart->get();
        }


        return response()->json($jabatan);

    }

}
