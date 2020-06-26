<?php

namespace App\Http\Controllers;

use App\Alumni;
use App\Mahasiswa;
use App\Perusahaan;
use App\HistoryPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countAlumni = Alumni::count();
        $countMhs = Mahasiswa::count();
        $countPerusahaan = Perusahaan::count();
        $countKuesioner = HistoryPekerjaan::count();
        return view('home-admin', compact('countAlumni', 'countMhs', 'countPerusahaan', 'countKuesioner'));
    }
}
