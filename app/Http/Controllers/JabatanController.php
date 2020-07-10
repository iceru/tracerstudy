<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = Jabatan::paginate(10);
        return view('jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Jabatan::insert([
            'id' => $id = IdGenerator::generate(['table' => 'jabatan', 'length' => 6, 'prefix' =>'JB-']),
            'nama_jabatan' => $request->nama_jabatan
        ]);

        return redirect('jabatan');
    }

     /**
     * Store a newly created resource in storage on client side.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storealumni(Request $request)
    {
        $validate = request()->validate([
            'nama_jabatan' => 'required|unique:jabatan,nama_jabatan',
        ]);
        Jabatan::insert([
            'id' => $id = IdGenerator::generate(['table' => 'jabatan', 'length' => 6, 'prefix' =>'JB-']),
            'nama_jabatan' => $request->nama_jabatan
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jabatan = Jabatan::where('id', $id)->firstOrFail();
        return view ('jabatan.edit', ['jabatan'=> $jabatan ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::where('id', $id)->update([
            'nama_jabatan' => $request->nama_jabatan
        ]);

        return redirect('/jabatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::where('id', $id)->delete();

        return redirect('/jabatan');
    }
}
