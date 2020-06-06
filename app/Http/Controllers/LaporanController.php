<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Perusahaan;
use App\Jabatan;

class LaporanController extends Controller
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
            ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
            ->select('alumni.id', 'alumni.NIM', 'mahasiswa.nama_mhs', 'perusahaan.alamat_perusahaan',
                    'perusahaan.latitude', 'perusahaan.longitude',)
            ->selectRaw("{$sqlDistance} AS distance")
            ->orderBy('alumni.id')
            ->get();

            return view ('laporan.jarak', compact('alumni'));
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

    public function jabatan() {
        $jabatan = DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select('mahasiswa.nama_mhs', 'alumni.no_hp', 'alumni.email', 'perusahaan.nama_perusahaan', 'jabatan.nama_jabatan')
        ->get();

        return view ('laporan.jabatan-perusahaan', compact('jabatan'));
    }

    public function indexChartJabatan() {
        $jabatan =  DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select(DB::raw("COUNT(jabatan.nama_jabatan) as countJabatan"), 'jabatan.nama_jabatan', 'jabatan.id')
        ->groupBy('jabatan.nama_jabatan', 'jabatan.id')
        ->get();

        return view('laporan.chartJabatan', compact('jabatan'));
    }


    public function showJabatan ($id) {
        $jabatanNama = Jabatan::where('id', $id)->first();

        $jabatan =  DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select('jabatan.nama_jabatan', 'mahasiswa.nama_mhs', 'alumni.no_hp', 'alumni.email', 'perusahaan.nama_perusahaan')
        ->where('jabatan.id', $id)
        ->get();
        return view ('laporan.detailJabatan', ['jabatan'=> $jabatan, 'jabatanNama' => $jabatanNama ]);
    }


    public function chartJabatan() {
        $jabatan =  DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select(DB::raw("COUNT(jabatan.nama_jabatan) as countJabatan"), 'jabatan.nama_jabatan')
        ->groupBy('jabatan.nama_jabatan')
        ->get();

        return response()->json($jabatan);

    }

    public function indexChartPerusahaan() {
        $perusahaan =  DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select(DB::raw("COUNT(perusahaan.nama_perusahaan) as countPerusahaan"), 'perusahaan.nama_perusahaan', 'perusahaan.alamat_perusahaan', 'perusahaan.id')
        ->groupBy('perusahaan.nama_perusahaan', 'perusahaan.alamat_perusahaan', 'perusahaan.id')
        ->get();

        return view('laporan.chartPerusahaan', compact('perusahaan'));
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
