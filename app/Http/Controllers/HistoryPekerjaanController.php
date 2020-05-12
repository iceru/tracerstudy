<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryPekerjaan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Alumni;
use App\Jabatan;
use App\Perusahaan;

class HistoryPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $jabatan = Jabatan::all();
        $perusahaan = Perusahaan::all();
        $alumni = Alumni::where('id', $id)->firstOrFail();
        return view('pekerjaan-alumni', compact('jabatan', 'perusahaan', 'alumni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $history = new HistoryPekerjaan();
        $history['id'] = IdGenerator::generate(['table' => 'history_pekerjaan', 'length' => 6, 'prefix' =>'HP-']);
        $history['id_alumni'] = $request->input('id_alumni');
        $history['id_jabatan'] = $request->input('id_jabatan');
        $history['id_perusahaan'] = $request->input('id_perusahaan');

        $history->save();

        $id = $history->id;
        return redirect()->route('kuesioner.show', ['id' => $id]);

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
        //
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
        //
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
