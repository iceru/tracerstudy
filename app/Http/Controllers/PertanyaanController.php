<?php

namespace App\Http\Controllers;

use App\Pertanyaan;
use App\PertanyaanDirect;
use App\PertanyaanMultiple;
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
        $pertanyaan = Pertanyaan::all();
        return view('kuesioner.pertanyaan.create', compact('pertanyaan'));
    }

    public function createMultiple()
    {
        $pertanyaan = PertanyaanMultiple::all();
        return view('kuesioner.pertanyaan.createMultiple', compact('pertanyaan'));
    }

    public function createDirect()
    {
        $pertanyaan = PertanyaanDirect::all();
        return view('kuesioner.pertanyaan.createDirect', compact('pertanyaan'));
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
        ]);

        return redirect()->route('pertanyaan.create');
    }

    public function storeDirect(Request $request)
    {
        $pertanyaan = PertanyaanDIrect::insert([
            'id' => $id = IdGenerator::generate(['table' => 'pertanyaan_direct_answer', 'length' => 6, 'prefix' =>'PD-']),
            'nama_pertanyaan_da' => $request->nama_pertanyaan,
        ]);

        return redirect()->route('pertanyaan.createDirect');
    }


    public function storeMultiple(Request $request)
    {
        $pertanyaan = PertanyaanMultiple::insert([
            'id' => $id = IdGenerator::generate(['table' => 'pertanyaan_multiple_answer', 'length' => 6, 'prefix' =>'PM-']),
            'nama_pertanyaan_ma' => $request->nama_pertanyaan,
        ]);

        return redirect()->route('pertanyaan.createMultiple');
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
        $pertanyaan = Pertanyaan::where('id', $id)->firstOrFail();
        return view ('kuesioner.pertanyaan.edit', ['pertanyaan'=> $pertanyaan ]);
    }

    public function editDirect($id)
    {
        $pertanyaan = PertanyaanDirect::where('id', $id)->firstOrFail();
        return view ('kuesioner.pertanyaan.editDirect', ['pertanyaan'=> $pertanyaan ]);
    }

    public function editMultiple($id)
    {
        $pertanyaan = PertanyaanMultiple::where('id', $id)->firstOrFail();
        return view ('kuesioner.pertanyaan.editMultiple', ['pertanyaan'=> $pertanyaan ]);
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
        ]);
        return redirect()->route('pertanyaan.create');
    }

    public function updateDirect(Request $request, $id)
    {
        $pertanyaan = PertanyaanDirect::where('id', $id)->update([
            'nama_pertanyaan_da' => $request->nama_pertanyaan,
        ]);
        return redirect()->route('pertanyaan.createDirect');
    }

    public function updateMultiple(Request $request, $id)
    {
        $pertanyaan = PertanyaanMultiple::where('id', $id)->update([
            'nama_pertanyaan_ma' => $request->nama_pertanyaan,
        ]);
        return redirect()->route('pertanyaan.createMultiple');
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

        return redirect()->route('pertanyaan.create');
    }

    public function destroyDirect($id)
    {
        $pertanyaan = PertanyaanDirect::where('id', $id)->delete();

        return redirect()->route('pertanyaan.createDirect');
    }

    public function destroyMultiple($id)
    {
        $pertanyaan = PertanyaanMultiple::where('id', $id)->delete();

        return redirect()->route('pertanyaan.createMultiple');
    }

}
