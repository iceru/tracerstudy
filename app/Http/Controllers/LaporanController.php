<?php

namespace App\Http\Controllers;
use DB;
use App\Prodi;
use App\Jabatan;
use App\Jawaban;
use App\Fakultas;
use App\Pertanyaan;
use App\Perusahaan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() {
        return view('laporan.indexLaporan');
    }

    public function indexChartBidang() {
        $bidang = DB::table('jawaban')
        ->join('pertanyaan','pertanyaan.id','jawaban.id_pertanyaan')
        ->join('opsi_pertanyaan', 'opsi_pertanyaan.id', 'jawaban.id_opsi')
        ->join('alumni', 'alumni.id', 'jawaban.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi' )
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->select(DB::raw("COUNT(opsi_pertanyaan.nama_opsi) as countBidang"), 'opsi_pertanyaan.nama_opsi', 'opsi_pertanyaan.id')
        ->groupBy('opsi_pertanyaan.nama_opsi', 'opsi_pertanyaan.id')
        ->where('pertanyaan.nama_pertanyaan', 'like', '%erat%');

        if(request('fakultas')) {
            $data = $bidang->where('nama_fakultas', '=', request('fakultas'))->get();
            $fakultasNama = request('fakultas');
        }

        else {
            $fakultasNama = 'Fakultas';
        }

        if(request('prodi')) {
            $data = $bidang->where('nama_prodi', '=', request('prodi'))->get();
            $prdName = request('prodi');
        }

        else {
            $prdName = 'Program Studi';
        }

        if(request('lulusan')) {
            $data = $bidang->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
            $llsName = request('lulusan');
        }

        else {
            $data = $bidang->get();
            $llsName = 'Tahun Lulusan';
        }

        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();

        return view('laporan.chartBidang', compact('data', 'prodi', 'fakultas', 'lulusan', 'prdName', 'fakultasNama', 'llsName'));
    }

    public function showBidang ($id) {
        $bidang = DB::table('jawaban')
        ->join('pertanyaan','pertanyaan.id','jawaban.id_pertanyaan')
        ->join('opsi_pertanyaan', 'opsi_pertanyaan.id', 'jawaban.id_opsi')
        ->join('alumni', 'alumni.id', 'jawaban.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->select('mahasiswa.nama_mhs', 'opsi_pertanyaan.nama_opsi', 'alumni.no_hp', 'alumni.email')
        ->where('opsi_pertanyaan.id', $id)
        ->where('pertanyaan.nama_pertanyaan', 'like', '%erat%')
        ->get();
        return view ('laporan.detailBidang', ['bidang'=> $bidang]);
    }

    public function chartBidang() {
        $bidang = DB::table('jawaban')
        ->join('pertanyaan','pertanyaan.id','jawaban.id_pertanyaan')
        ->join('opsi_pertanyaan', 'opsi_pertanyaan.id', 'jawaban.id_opsi')
        ->join('alumni', 'alumni.id', 'jawaban.id_alumni')
        ->select(DB::raw("COUNT(opsi_pertanyaan.nama_opsi) as countBidang"), 'opsi_pertanyaan.nama_opsi')
        ->groupBy('opsi_pertanyaan.nama_opsi')
        ->where('pertanyaan.nama_pertanyaan', 'like', '%erat%')
        ->get();

        return response()->json($bidang);
    }

    public function indexChartWaktuPekerjaan() {
        $waktu = DB::table('jawaban_direct_answer')
        ->join('pertanyaan_direct_answer','pertanyaan_direct_answer.id','jawaban_direct_answer.id_pertanyaan_da')
        ->join('alumni', 'alumni.id', 'jawaban_direct_answer.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi' )
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->select(DB::raw("COUNT(jawaban) as countBidang"), 'jawaban')
        ->groupBy('jawaban')
        ->where('pertanyaan_direct_answer.nama_pertanyaan_da', 'like', '%dihabiskan%');

        if(request('fakultas')) {
            $data = $waktu->where('nama_fakultas', '=', request('fakultas'))->get();
            $fakultasNama = request('fakultas');
        }

        else {
            $fakultasNama = 'Fakultas';
        }

        if(request('prodi')) {
            $data = $waktu->where('nama_prodi', '=', request('prodi'))->get();
            $prdName = request('prodi');
        }

        else {
            $prdName = 'Program Studi';
        }

        if(request('lulusan')) {
            $data = $waktu->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
            $llsName = request('lulusan');
        }

        else {
            $data = $waktu->get();
            $llsName = 'Tahun Lulusan';
        }

        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();


        return view('laporan.chartWaktuPekerjaan', compact('data', 'prodi', 'fakultas', 'lulusan', 'prdName', 'fakultasNama', 'llsName'));
    }

    public function chartWaktuPekerjaan() {
        $waktu = DB::table('jawaban_direct_answer')
        ->join('pertanyaan_direct_answer','pertanyaan_direct_answer.id','jawaban_direct_answer.id_pertanyaan_da')
        ->select(DB::raw("COUNT(jawaban) as countBidang"), 'jawaban')
        ->groupBy('jawaban')
        ->where('pertanyaan_direct_answer.nama_pertanyaan_da', 'like', '%dihabiskan%')
        ->get();
        return response()->json($waktu);
    }

    public function showWaktuPekerjaan ($jawaban) {
        $waktu = DB::table('jawaban_direct_answer')
        ->join('pertanyaan_direct_answer','pertanyaan_direct_answer.id','jawaban_direct_answer.id_pertanyaan_da')
        ->join('alumni', 'alumni.id', 'jawaban_direct_answer.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->select('mahasiswa.nama_mhs','jawaban', 'alumni.no_hp', 'alumni.email')
        ->where('jawaban', $jawaban)
        ->where('pertanyaan_direct_answer.nama_pertanyaan_da', 'like', '%dihabiskan%')
        ->get();
        return view ('laporan.detailWaktuPekerjaan', ['waktu'=> $waktu]);
    }


    public function tahunKelulusan() {
        $tidakValid = DB::table('mahasiswa')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi')
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->select(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2)) AS tahunKelulusan, COUNT(YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))) AS hitungKelulusan"))
        ->whereBetween(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))"), [8,20])
        ->groupBy(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))"))
        ->get();

        $tidakValid2 = DB::table('mahasiswa')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi')
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->select(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2)) AS tahunKelulusan, COUNT(YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))) AS hitungKelulusan"))
        ->whereBetween(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))"), [1,3])
        ->groupBy(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))"))
        ->get();

        $tahunLulus = DB::table('mahasiswa')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi')
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->select(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2)) AS tahunKelulusan, COUNT(YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))) AS hitungKelulusan"))
        ->whereBetween(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))"), [3,7])
        ->groupBy(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))"));

        if(request('fakultas')) {
            $data = $tahunLulus->where('nama_fakultas', '=', request('fakultas'))->get();
            $fakultasNama = request('fakultas');
        }

        else {
            $fakultasNama = 'Fakultas';
        }

        if(request('prodi')) {
            $data = $tahunLulus->where('nama_prodi', '=', request('prodi'))->get();
            $prdName = request('prodi');
        }

        else {
            $prdName = 'Program Studi';
        }

        if(request('lulusan')) {
            $data = $tahunLulus->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
            $llsName = request('lulusan');
        }

        else {
            $data = $tahunLulus->get();
            $llsName = 'Tahun Lulusan';
        }

        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();

        return view('laporan.tahunKelulusan', compact('data', 'prodi', 'fakultas', 'lulusan', 'prdName', 'fakultasNama', 'llsName','tidakValid', 'tidakValid2'));
    }

    public function chartTahunKelulusan() {
        $tahunLulus = DB::table('mahasiswa')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi')
        ->select(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2)) AS tahunKelulusan, COUNT(YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))) AS hitungKelulusan"))
        ->groupBy(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))"))
        ->get();

        return response()->json($tahunLulus);
    }


    public function detailKelulusan($lulusan) {
        $tahunLulus = DB::table('mahasiswa')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi')
        ->select(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2)) AS tahunKelulusan, MONTH(tgl_yudisium) AS bulankelulusan" ), 'mahasiswa.nama_mhs', 'mahasiswa.NIM', 'program_studi.nama_prodi','mahasiswa.tgl_yudisium')
        ->where(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))"), $lulusan)
        ->get();

        return view ('laporan.detailKelulusan', compact('tahunLulus'));
    }

    public function kepuasanAlumni() {
        $kepuasan = Pertanyaan::where('nama_pertanyaan', 'like', '%embelajar%')->groupBy('id')->get();
        return view('laporan.kepuasanAlumni', compact('kepuasan'));
    }

    public function chartKepuasanAlumni() {
        $kepuasan = DB::table('jawaban')
        ->join('pertanyaan','pertanyaan.id','jawaban.id_pertanyaan')
        ->join('opsi_pertanyaan', 'opsi_pertanyaan.id', 'jawaban.id_opsi')
        ->join('alumni', 'alumni.id', 'jawaban.id_alumni')
        ->join('mahasiswa','mahasiswa.NIM','alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi')
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->select(DB::raw("COUNT(opsi_pertanyaan.nama_opsi) as countBidang"), 'opsi_pertanyaan.nama_opsi', 'opsi_pertanyaan.id', 'pertanyaan.nama_pertanyaan')
        ->groupBy('opsi_pertanyaan.nama_opsi', 'opsi_pertanyaan.id', 'pertanyaan.nama_pertanyaan')
        ->where('pertanyaan.nama_pertanyaan', 'like', '%embelajara%');

        if(request('fakultas')) {
            $data = $kepuasan->where('nama_fakultas', '=', request('fakultas'))->get();
            $fakultasNama = request('fakultas');
        }

        else {
            $fakultasNama = 'Fakultas';
        }

        if(request('prodi')) {
            $data = $kepuasan->where('nama_prodi', '=', request('prodi'))->get();
            $prdName = request('prodi');
        }

        else {
            $prdName = 'Program Studi';
        }

        if(request('lulusan')) {
            $data = $kepuasan->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'))->get();
            $llsName = request('lulusan');
        }

        else {
            $data = $kepuasan->get();
            $llsName = 'Tahun Lulusan';
        }

        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();

        return view('laporan.kepuasanAlumni', compact('data', 'prodi', 'fakultas', 'lulusan', 'prdName', 'fakultasNama', 'llsName'));
    }

}
