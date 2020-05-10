<?php

namespace App\Http\Controllers;

use App\Opsi;
use App\Pertanyaan;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class OpsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opsi = Opsi::paginate(10);
        $pertanyaan = Pertanyaan::all();
        return view('opsi', compact('opsi', 'pertanyaan'));
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
        $opsi = Opsi::insert([
            'id' => $id = IdGenerator::generate(['table' => 'opsi_pertanyaan', 'length' => 6, 'prefix' =>'OP-']),
            'nama_opsi' => $request->nama_opsi,
            'id_pertanyaan' => $request->id_pertanyaan
        ]);

        return redirect('/opsi-pertanyaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Opsi  $opsi
     * @return \Illuminate\Http\Response
     */
    public function show(Opsi $opsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Opsi  $opsi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opsi = Opsi::where('id', $id)->firstOrFail();
        $pertanyaan = Pertanyaan::all();
        return view ('updateopsi', ['opsi'=> $opsi ], compact('pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Opsi  $opsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $opsi = Opsi::where('id', $id)->update([
            'nama_opsi' => $request->nama_opsi,
            'id_pertanyaan' => $request->id_pertanyaan
        ]);
        return redirect('/opsi-pertanyaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Opsi  $opsi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opsi = Opsi::where('id', $id)->delete();

        return redirect('/opsi-pertanyaan');
    }
}
