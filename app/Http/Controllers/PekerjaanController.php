<?php

namespace App\Http\Controllers;

use App\Prodi;
use App\Alumni;
use App\Jabatan;
use App\Fakultas;
use App\Perusahaan;
use App\HistoryPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = DB::table('history_pekerjaan')
        ->join('alumni','alumni.id','history_pekerjaan.id_alumni')
        ->join('mahasiswa', 'mahasiswa.NIM', 'alumni.NIM')
        ->join('program_studi', 'program_studi.id', 'mahasiswa.id_prodi' )
        ->join ('fakultas', 'fakultas.id', 'program_studi.id_fakultas')
        ->join('perusahaan', 'perusahaan.id', 'history_pekerjaan.id_perusahaan')
        ->join('jabatan', 'jabatan.id', 'history_pekerjaan.id_jabatan')
        ->select('mahasiswa.nama_mhs', 'history_pekerjaan.id', 'history_pekerjaan.created_at', 'alumni.no_hp', 'alumni.email', 'perusahaan.nama_perusahaan', 'jabatan.nama_jabatan', 'program_studi.nama_prodi', 'fakultas.nama_fakultas', DB::raw("YEAR(tgl_yudisium) AS lulus"));

        if(request('fakultas')) {
            $data = $jabatan->where('nama_fakultas', '=', request('fakultas'))->get();
            $fklName = request('fakultas');
        }

        else {
            $fklName = 'Fakultas';
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

        return view ('pekerjaan.index', compact('data', 'prodi', 'fakultas', 'lulusan', 'prdName', 'fklName', 'llsName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alumni = Alumni::all();
        $perusahaan = Perusahaan::all();
        $jabatan = Jabatan::all();
        return view('pekerjaan.create', compact('alumni', 'jabatan', 'perusahaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = request()->validate([
            'id_alumni' => 'required',
            'id_jabatan' => 'required',
            'id_perusahaan' => 'required',
        ]);

        HistoryPekerjaan::insert([
            'id' => IdGenerator::generate(['table' => 'history_pekerjaan', 'length' => 6, 'prefix' =>'HP-']),
            'id_alumni' => $request->id_alumni,
            'id_jabatan' => $request->id_jabatan,
            'id_perusahaan' => $request->id_perusahaan,
        ]);

        return redirect()->route('pekerjaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pekerjaan = HistoryPekerjaan::where('id', $id)->firstOrFail();
        $alumni = Alumni::all();
        $perusahaan = Perusahaan::all();
        $jabatan = Jabatan::all();
        return view ('pekerjaan.edit', ['pekerjaan'=> $pekerjaan ], compact('jabatan','alumni', 'perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = request()->validate([
            'id_alumni' => 'required',
            'id_jabatan' => 'required',
            'id_perusahaan' => 'required',
        ]);

        HistoryPekerjaan::where('id', $id)->update([
            'id_alumni' => $request->id_alumni,
            'id_jabatan' => $request->id_jabatan,
            'id_perusahaan' => $request->id_perusahaan,
        ]);

        return redirect()->route('pekerjaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
