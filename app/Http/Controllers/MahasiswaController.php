<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Prodi;
use Illuminate\Http\Request;
use Excel;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::paginate(20);
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::paginate(10);
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
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    /**
     * Import from Excel File
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
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
        Mahasiswa::insert([
            'NIM' => $request->NIM,
            'nama_mhs' => $request->nama_mhs,
            'tgl_yudisium' => $request->tgl_yudisium,
            'ipk' => $request->ipk,
            'id_prodi' => $request->id_prodi,
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
}
