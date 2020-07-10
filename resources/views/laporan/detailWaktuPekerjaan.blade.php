@extends('layout.adminapp')

@section('content')
<div class="wrap-input">
    <a href="{{ route('laporan.indexChartWaktuPekerjaan') }}"><i class="fas fa-arrow-left    "></i> &nbsp; Kembali ke Laporan Kesesuaian Bidang</a>
    <h3 class="mt-3">List Alumni</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alumni</th>
                <th>Kontak</th>
                <th>Email</th>
                <th>Waktu yang dibutuhkan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($waktu as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_mhs }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->jawaban }} Bulan</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
