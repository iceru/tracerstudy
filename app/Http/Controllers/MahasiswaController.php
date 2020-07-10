<?php

namespace App\Http\Controllers;

use Excel;
use App\Prodi;
use App\Fakultas;
use App\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('fakultas')) {
            $fakultas = Fakultas::all();
            $fklName = $fakultas->where('nama_fakultas', request('fakultas'))->first()->nama_fakultas;
        }

        else {
            $fakultas = Fakultas::all();
            $fklName = 'Fakultas';
        }

        if(request('prodi')) {
            $prodi = Prodi::all();
            $prdName = $prodi->where('nama_prodi', request('prodi'))->first()->nama_prodi;
        }

        else {
            $prodi = Prodi::all();
            $prdName = 'Program Studi';
        }

        if(request('lulusan')) {
            $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();
        }

        else {
            $lulusan = DB::table("mahasiswa")
            ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
            ->orderBy('tgl_yudisium')
            ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
            ->get();
        }

        $mahasiswa = Mahasiswa::filter()->paginate(20);
        return view('mahasiswa.index', compact('mahasiswa', 'prodi', 'fakultas', 'fklName', 'prdName', 'lulusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::paginate(20);
        $prodi = Prodi::all();
        return view('mahasiswa.create', compact('mahasiswa', 'prodi'));
    }

    /**
     * Export from Excel File
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $tanggal = date('Y-m-d');
        return Excel::download(new MahasiswaExport, $tanggal . ' - mahasiswa.xlsx');
    }

    /**
     * Import from Excel File
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        $validate = request()->validate([
            'file' => 'required',
        ]);

        Excel::import(new MahasiswaImport,request()->file('file'));
        return back();
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
            'NIM' => 'required|unique:mahasiswa,NIM|max:9',
            'nama_mhs' => 'required',
            'tgl_yudisium' => 'required',
            'ipk' => 'required',
            'id_prodi' => 'required'
        ]);

        Mahasiswa::insert([
            'NIM' => $request->NIM,
            'nama_mhs' => $request->nama_mhs,
            'tgl_yudisium' => $request->tgl_yudisium,
            'ipk' => $request->ipk,
            'id_prodi' => $request->id_prodi,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect('/mahasiswa');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storealumni(Request $request)
    {
        Mahasiswa::insert([
            'NIM' => $request->NIM,
            'nama_mhs' => $request->nama_mhs,
            'tgl_yudisium' => $request->tgl_yudisium,
            'ipk' => $request->ipk,
            'id_prodi' => $request->id_prodi,
        ]);

        return redirect()->route('alumni.create');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('NIM', $id)->firstOrFail();
        $prodi = Prodi::all();
        return view ('mahasiswa.edit', ['mahasiswa'=> $mahasiswa ], compact('prodi'));
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
        $mahasiswa = Mahasiswa::where('NIM', $id)->update([
            'NIM' => $request->NIM,
            'nama_mhs' => $request->nama_mhs,
            'tgl_yudisium' => $request->tgl_yudisium,
            'ipk' => $request->ipk,
            'id_prodi' => $request->id_prodi,
        ]);

        return redirect('/mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('NIM', $id)->delete();

        return redirect('/mahasiswa');
    }

    public function chartMhs() {
        $chartMhs = DB::table('mahasiswa')
        ->join('program_studi','program_studi.id','mahasiswa.id_prodi')
        ->select(DB::raw("COUNT(program_studi.nama_prodi) as countProdi"), 'program_studi.nama_prodi')
        ->groupBy('program_studi.nama_prodi')
        ->get();

        return response()->json($chartMhs);
    }
}
