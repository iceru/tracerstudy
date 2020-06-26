<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sektor;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SektorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sektor = Sektor::paginate(10);
        return view('perusahaan.sektor.index', compact('sektor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perusahaan.sektor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sektor = Sektor::insert([
            'id' => $id = IdGenerator::generate(['table' => 'sektor_perusahaan', 'length' => 6, 'prefix' =>'SP-']),
            'nama_sektor' => $request->nama_sektor,
        ]);

        return redirect('/sektor');
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
        $sektor = Sektor::where('id', $id)->firstOrFail();
        return view ('perusahaan.sektor.edit', ['sektor' => $sektor]);
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
        $sektor = Sektor::where('id', $id)->update([
            'nama_sektor' => $request->nama_sektor,
        ]);

        return redirect('/sektor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sektor = Sektor::where('id', $id)->delete();

        return redirect('/sektor');
    }

    public function storeAlumni(Request $request)
    {
        $sektor = Sektor::insert([
            'id' => $id = IdGenerator::generate(['table' => 'sektor_perusahaan', 'length' => 6, 'prefix' =>'SP-']),
            'nama_sektor' => $request->nama_sektor,
        ]);

        return back();
    }

    public function createAlumni() {
        return view('sektor-alumni');
    }
}
