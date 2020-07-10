<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use App\Sektor;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perusahaan = Perusahaan::paginate(10);
        $sektor = Sektor::all();
        return view('perusahaan.index', compact('perusahaan', 'sektor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sektor = Sektor::all();
        return view('perusahaan.create', compact('sektor'));
    }

    public function createAlumni()
    {
        $sektor = Sektor::all();
        return view('perusahaan-alumni', compact('sektor'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Perusahaan::insert([
            'id' => $id = IdGenerator::generate(['table' => 'perusahaan', 'length' => 6, 'prefix' =>'P-']),
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'regional' => $request->regional,
            'nomor_perusahaan' => $request->nomor_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,
            'id_sektor' => $request->id_sektor,
        ]);

        return redirect('/perusahaan');
    }

    /**
     * Store a newly created resource in storage on client side.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storealumni(Request $request)
    {
        Perusahaan::insert([
            'id' => $id = IdGenerator::generate(['table' => 'perusahaan', 'length' => 6, 'prefix' =>'P-']),
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'regional' => $request->regional,
            'nomor_perusahaan' => $request->nomor_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,
            'id_sektor' => $request->id_sektor,
        ]);

        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perusahaan = Perusahaan::where('id', $id)->firstOrFail();
        $sektor = Sektor::all();
        return view ('perusahaan.edit', ['perusahaan'=> $perusahaan ], compact('sektor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::where('id', $id)->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'regional' => $request->regional,
            'nomor_perusahaan' => $request->nomor_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,
            'id_sektor' => $request->id_sektor,
        ]);

        return redirect('/perusahaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perusahaan = Perusahaan::where('id', $id)->delete();

        return redirect('/perusahaan');
    }
}
