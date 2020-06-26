<?php

namespace App\Http\Controllers;

use App\Opsi;
use App\Pertanyaan;
use App\OpsiMultiple;
use App\PertanyaanMultiple;
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opsis = Opsi::paginate(10);
        $pertanyaan = Pertanyaan::all();
        return view('kuesioner.opsi.create', compact('opsis', 'pertanyaan'));
    }

    public function createMultiple()
    {
        $opsis = OpsiMultiple::paginate(10);
        $pertanyaan = PertanyaanMultiple::all();
        return view('kuesioner.opsi.createMultiple', compact('opsis', 'pertanyaan'));
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
            'pertanyaan_id' => $request->id_pertanyaan
        ]);

        return redirect('/opsi-pertanyaan');
    }

    public function storeMultiple(Request $request)
    {
        $opsi = OpsiMultiple::insert([
            'id' => $id = IdGenerator::generate(['table' => 'opsi_pertanyaan_ma', 'length' => 6, 'prefix' =>'OP-']),
            'nama_opsi_ma' => $request->nama_opsi,
            'id_pertanyaan_ma' => $request->id_pertanyaan
        ]);

        return redirect()->route('opsi.createMultiple');
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
        return view ('kuesioner.opsi.edit', ['opsi'=> $opsi ], compact('pertanyaan'));
    }

    public function editMultiple($id)
    {
        $opsi = OpsiMultiple::where('id', $id)->firstOrFail();
        $pertanyaan = PertanyaanMultiple::all();
        return view ('kuesioner.opsi.editMultiple', ['opsi'=> $opsi ], compact('pertanyaan'));
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
            'pertanyaan_id' => $request->id_pertanyaan
        ]);
        return redirect('/opsi-pertanyaan');
    }

    public function updateMultiple(Request $request, $id)
    {
        $opsi = OpsiMultiple::where('id', $id)->update([
            'nama_opsi_ma' => $request->nama_opsi,
            'id_pertanyaan_ma' => $request->id_pertanyaan
        ]);
        return redirect()->route('opsi.createMultiple');
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

    public function destroyMultiple($id)
    {
        $opsi = OpsiMultiple::where('id', $id)->delete();

        return redirect()->route('opsi.createMultiple');
    }
}
