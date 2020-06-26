<?php

namespace App\Http\Controllers;
use DB;
use App\Prodi;
use App\Jabatan;
use App\Jawaban;
use App\Fakultas;
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
        ->select(DB::raw("COUNT(opsi_pertanyaan.nama_opsi) as countBidang"), 'opsi_pertanyaan.nama_opsi', 'opsi_pertanyaan.id')
        ->groupBy('opsi_pertanyaan.nama_opsi', 'opsi_pertanyaan.id')
        ->where('pertanyaan.nama_pertanyaan', 'like', '%erat%')
        ->get();

        return view('laporan.chartBidang', compact('bidang'));
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
        ->select(DB::raw("COUNT(jawaban) as countBidang"), 'jawaban')
        ->groupBy('jawaban')
        ->where('pertanyaan_direct_answer.nama_pertanyaan_da', 'like', '%dihabiskan%')
        ->get();

        return view('laporan.chartWaktuPekerjaan', compact('waktu'));
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

        $tahunLulus = DB::table('alumni')
        ->join('mahasiswa','mahasiswa.NIM','alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi')
        ->select(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2)) AS tahunKelulusan, COUNT(YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))) AS hitungKelulusan"))
        ->groupBy(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))"))
        ->get();

        return view('laporan.tahunKelulusan', compact('tahunLulus'));
    }

    public function detailKelulusan($lulusan) {
        $tahunLulus = DB::table('alumni')
        ->join('mahasiswa','mahasiswa.NIM','alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi')
        ->select(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2)) AS tahunKelulusan"), 'mahasiswa.nama_mhs', 'program_studi.nama_prodi')
        ->where(DB::raw("YEAR(tgl_yudisium) - (2000 + substr(mahasiswa.NIM, 4, 2))"), $lulusan)
        ->get();

        return view ('laporan.detailKelulusan', compact('tahunLulus'));
    }

    public function kepuasanAlumni() {
        $bidang = DB::table('jawaban')
        ->join('pertanyaan','pertanyaan.id','jawaban.id_pertanyaan')
        ->join('opsi_pertanyaan', 'opsi_pertanyaan.id', 'jawaban.id_opsi')
        ->join('alumni', 'alumni.id', 'jawaban.id_alumni')
        ->select(DB::raw("COUNT(opsi_pertanyaan.nama_opsi) as countBidang"), 'opsi_pertanyaan.nama_opsi', 'opsi_pertanyaan.id')
        ->groupBy('opsi_pertanyaan.nama_opsi', 'opsi_pertanyaan.id')
        ->where('pertanyaan.nama_pertanyaan', 'like', '%erat%')
        ->get();

        return view('laporan.chartBidang', compact('bidang'));
    }


}
