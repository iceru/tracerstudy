<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prodi;
use App\Fakultas;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodi = Prodi::orderBy('id_fakultas')->paginate(20);
        $fakultas = Fakultas::all();

        return view('prodi.index', compact('prodi', 'fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prodi = Prodi::paginate(8);
        $fakultas = Fakultas::all();

        return view('prodi.create', compact('prodi', 'fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = request()->validate([
            'id' =>'required|unique:program_studi, id',
            'nama_prodi' => 'required|unique:program_studi, nama_prodi',
            'id_fakultas' => 'required',
        ],
        [
            'id.unique' => 'ID Program Studi sudah ada',
            'id.nama_prodi' => 'Nama Program Studi sudah ada',
        ]);

        Prodi::insert([
            'id' => $request->id_prodi,
            'nama_prodi' => $request->nama_prodi,
            'id_fakultas' => $request->id_fakultas,
        ]);

        return redirect('/prodi');
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
        $prodi = Prodi::where('id', $id)->firstOrFail();
        $fakultas = Fakultas::all();
        return view ('prodi.edit', ['prodi'=> $prodi ], compact('fakultas'));
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
        $prodi = Prodi::where('id', $id)->update([
            'id' => $request->id_prodi,
            'nama_prodi' => $request->nama_prodi,
            'id_fakultas' => $request->id_fakultas,
        ]);

        return redirect('/prodi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prodi = Prodi::where('id', $id)->delete();

        return redirect('/prodi');
    }
}
