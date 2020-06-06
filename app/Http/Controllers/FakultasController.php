<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fakultas;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fakultas = Fakultas::paginate(10);
        return view('fakultas.index', compact('fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Fakultas::insert([
            'id' => $id = IdGenerator::generate(['table' => 'fakultas', 'length' => 6, 'prefix' =>'FK-']),
            'nama_fakultas' => $request->nama_fakultas
        ]);

        return redirect('/fakultas');
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
        $fakultas = Fakultas::where('id', $id)->firstOrFail();
        return view ('fakultas.edit', ['fakultas'=> $fakultas ]);
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
        $fakultas = Fakultas::where('id', $id)->update([
            'nama_fakultas' => $request->nama_fakultas
        ]);

        return redirect('/fakultas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fakultas = Fakultas::where('id', $id)->delete();

        return redirect('/fakultas');
    }
}
