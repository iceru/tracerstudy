@extends('layout.adminapp')

@section('title')
Laporan Tracer Study
@endsection

@section('content')
<h2 class="py-3">Laporan Tracer Study Universitas Tarumanagara</h2>
<div class="grid-card">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('jarak.haversine') }}">
                <div class="kartu kartuQS">
                    <h4 style="margin: auto 0"><i class="fas fa-globe-asia    "></i> &nbsp; Jarak Perusahaan Alumni dengan Universitas</h4>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('laporan.jabatan') }}">
                <div class="kartu">
                    <h4><i class="fa fa-briefcase" aria-hidden="true"></i> &nbsp; Laporan Jabatan dan Perusahaan</h4>
                </div>
            </a>
            <a href="{{ route('kuesioner.hasil') }}">
                <div class="kartu">
                    <h4><i class="fas fa-poll    "></i> &nbsp; Hasil Kuesioner  </h4>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('laporan.indexChartWaktuPekerjaan') }}">
                <div class="kartu">
                    <h4><i class="fas fa-clock    "></i>  &nbsp; Laporan Alumni Berdasarkan Waktu Mendapatkan Pekerjaan</h4>
                </div>
            </a>
            <a href="{{ route('laporan.indexChartBidang') }}">
                <div class="kartu">
                    <h4><i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp; Laporan Alumni Berdasarkan Kesesuaian Bidang Pekerjaan</h4>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('laporan.tahunKelulusan') }}">
                <div class="kartu kartuQS">
                    <h4 style="margin: auto 0"><i class="fas fa-user-graduate    "></i> &nbsp; Laporan Alumni Berdasarkan Tahun Kelulusan</h4>
                </div>
            </a>
            {{-- <a href="{{ route('laporan.kepuasanAlumni') }}">
                <div class="kartu">
                    <h4>Laporan Tingkat Kepuasan Alumni Terhadap Program Studi</h4>
                </div>
            </a> --}}
        </div>
    </div>
</div>
@endsection
