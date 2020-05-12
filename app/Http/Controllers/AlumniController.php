<?php

namespace App\Http\Controllers;

use App\Alumni;
use App\Jabatan;
use App\Perusahaan;
use App\Mahasiswa;
use App\Prodi;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Excel;
use App\Exports\AlumniExport;
use App\Imports\AlumniImport;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnis = Alumni::paginate(10);
        $mahasiswa = Mahasiswa::all();
        return view ('alumni.index', compact('alumnis', 'mahasiswa'));
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

}
