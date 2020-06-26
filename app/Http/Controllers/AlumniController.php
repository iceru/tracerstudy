<?php

namespace App\Http\Controllers;

use Excel;
use App\Prodi;
use App\Alumni;
use App\Jabatan;
use App\Fakultas;
use App\Mahasiswa;
use App\Perusahaan;
use Illuminate\Http\Request;
use App\Exports\AlumniExport;
use App\Imports\AlumniImport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AlumniController extends Controller
{
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

        $alumnis = Alumni::filter()->paginate(10);
        $mahasiswa = Mahasiswa::all();
        return view ('alumni.index', compact('alumnis', 'mahasiswa', 'prodi', 'fakultas', 'fklName', 'prdName', 'lulusan'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function input()
    {

        $mahasiswa = Mahasiswa::all();
        $prodi = Prodi::all();
        return view ('alumni.input', compact('mahasiswa', 'prodi'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $prodi = Prodi::all();
        return view('alumni.create', compact('mahasiswa', 'prodi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alumni = new Alumni();
        $alumni['id'] = IdGenerator::generate(['table' => 'alumni', 'length' => 8, 'prefix' =>'AL-']);
        $alumni['NIM'] = $request->input('NIM');
        $alumni['email'] = $request->input('email');
        $alumni['no_hp'] = $request->input('no_hp');

        $alumni->save();

        $id = $alumni->id;
        return redirect()->route('historypekerjaan.index', ['id' => $id]);
    }

    public function storeadmin(Request $request)
    {
        $alumni = new Alumni();
        $alumni['id'] = IdGenerator::generate(['table' => 'alumni', 'length' => 8, 'prefix' =>'AL-']);
        $alumni['NIM'] = $request->input('NIM');
        $alumni['email'] = $request->input('email');
        $alumni['no_hp'] = $request->input('no_hp');

        $alumni->save();

        return redirect()->route('alumni.index');
    }


    /**
     * Export from Excel File
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new AlumniExport, 'alumni.xlsx');
    }

    /**
     * Import from Excel File
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
       Excel::import(new AlumniImport,request()->file('file'));
       return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function show(Alumni $alumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumni = Alumni::where('id', $id)->firstOrFail();
        $mahasiswa = Mahasiswa::all();
        return view ('alumni.edit', ['alumni'=> $alumni ], compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $alumni = Alumni::where('id', $id)->update([
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('alumni.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumni = Alumni::where('id', $id)->delete();

        return redirect()->route('alumni.index');
    }

    public function chartProgramStudi() {
        $alumniProdi = DB::table('alumni')
        ->join('mahasiswa','mahasiswa.NIM','alumni.NIM')
        ->join('program_studi','program_studi.id','mahasiswa.id_prodi')
        ->select(DB::raw("COUNT(program_studi.nama_prodi) as countProdi"), 'program_studi.nama_prodi')
        ->groupBy( 'program_studi.nama_prodi')
        ->get();

        return response()->json($alumniProdi);
    }

}
