<?php

namespace App\Http\Controllers;

use App\Opsi;
use App\Prodi;
use App\Alumni;
use App\Jawaban;
use App\Fakultas;
use App\Pertanyaan;
use App\JawabanDirect;
use App\JawabanMultiple;
use App\HistoryPekerjaan;
use App\PertanyaanDirect;
use App\PertanyaanMultiple;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class KuesionerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaan = Pertanyaan::all();
        $pertanyaanDa = PertanyaanDirect::all();
        $pertanyaanMa = PertanyaanMultiple::all();
        return view('kuesioner.admin', compact('pertanyaan', 'pertanyaanDa', 'pertanyaanMa'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertanyaan = Pertanyaan::all();
        $history = HistoryPekerjaan::where('id', $id)->first();
        return view('kuesioner.create', compact('pertanyaan', 'history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDirect($id)
    {
        $pertanyaanDirect = PertanyaanDirect::all();
        return view('kuesioner.createDirect', compact('pertanyaanDirect'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMultiple($id)
    {
        $pertanyaan = PertanyaanMultiple::all();
        return view('kuesioner.createMultiple', compact('pertanyaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $data = request()->validate([
            'responses.*.id_opsi' => 'required',
            'responses.*.id_pertanyaan' => 'required',
            'responses.*.id_alumni' => 'required'
        ]);

        $jawaban = Jawaban::insert($data['responses']);

        $id = $request->input('responses.0.id_alumni');

        return redirect()->route('kuesioner.createDirect', ['id' => $id]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDirect(Request $request) {
        $dataJawaban = request()->validate([
            'jawaban.*.jawaban' => 'required',
            'jawaban.*.id_pertanyaan_da' => 'required',
            'jawaban.*.id_alumni' => 'required'
        ]);

        $jawaban = JawabanDirect::insert($dataJawaban['jawaban']);

        $id = $request->input('jawaban.0.id_alumni');

        return redirect()->route('kuesioner.createMultiple', ['id' => $id]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMultiple(Request $request) {

        $jawabanMa = $request->get('id_opsi_ma'); // get all the checked values as array
        $pertanyaanMa = $request->get('id_pertanyaan_ma');

        for($count = 0; $count < count($jawabanMa); $count++)
        {
            $data = array(
                    'id_opsi_ma' => $jawabanMa[$count],
                    'id_pertanyaan_ma'  => $pertanyaanMa[$count],
                    'id_alumni'  => $request->id_alumni,
                    'created_at' => Carbon::now(),
                );

            $insert_data[] = $data;
        }
        JawabanMultiple::insert($insert_data);

        return view('thankyou');
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

    public function hasil()
    {
        if(request('fakultas')) {
            $fakultas = Fakultas::all();
            $fklName = $fakultas->where('nama_fakultas', request('fakultas'))->first()->nama_fakultas;
        }

        else {
            $fakultas = Fakultas::all();
            $fklName = 'Fakultas';
        }

        if(request('prodi')) {
            $prodi = Prodi::all();
            $prdName = $prodi->where('nama_prodi', request('prodi'))->first()->nama_prodi;
        }

        else {
            $prodi = Prodi::all();
            $prdName = 'Program Studi';
        }

        if(request('lulusan')) {
            $lulusan = DB::table("mahasiswa")
                ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
                ->orderBy('tgl_yudisium')
                ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
                ->get();
        }

        else {
            $lulusan = DB::table("mahasiswa")
            ->select(DB::raw("YEAR(tgl_yudisium) as lulusan"))
            ->orderBy('tgl_yudisium')
            ->groupBy(DB::raw("YEAR(tgl_yudisium)"))
            ->get();
        }

        $pertanyaan = Pertanyaan::all();
        $pertanyaanDa = PertanyaanDirect::all();
        $pertanyaanMa = PertanyaanMultiple::all();
        return view('laporan.hasilkuesioner', compact('pertanyaan', 'prodi', 'fakultas', 'fklName', 'prdName', 'lulusan', 'pertanyaanMa', 'pertanyaanDa'));
    }
}
