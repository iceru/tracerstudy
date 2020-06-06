<?php

namespace App\Http\Controllers;

use App\Pertanyaan;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = ['multiple-choice', 'multiple-answer', 'direct-answer'];
        $pertanyaan = Pertanyaan::all();
        return view('kuesioner.pertanyaan.create', compact('pertanyaan', 'jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pertanyaan = Pertanyaan::insert([
            'id' => $id = IdGenerator::generate(['table' => 'pertanyaan', 'length' => 6, 'prefix' =>'PA-']),
            'nama_pertanyaan' => $request->nama_pertanyaan,
            'jenis_pertanyaan' => $request->jenis_pertanyaan
        ]);

        return redirect('/pertanyaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis = ['multiple-choice', 'multiple-answer', 'direct-answer'];
        $pertanyaan = Pertanyaan::where('id', $id)->firstOrFail();
        return view ('kuesioner.pertanyaan.edit', ['pertanyaan'=> $pertanyaan ], compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pertanyaan = Pertanyaan::where('id', $id)->update([
            'nama_pertanyaan' => $request->nama_pertanyaan,
            'jenis_pertanyaan' => $request->jenis_pertanyaan
        ]);
        return redirect('/pertanyaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertanyaan = Pertanyaan::where('id', $id)->delete();

        return redirect('/pertanyaan');
    }
}
