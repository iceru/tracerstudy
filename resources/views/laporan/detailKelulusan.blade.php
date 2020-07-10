@extends('layout.adminapp')

@section('content')
<div class="wrap-input">
    <p><a class="redtext" href="{{ route('home') }}">Dahsboard</a> / <a class="redtext" href="{{ route('laporan.index') }}">Daftar Laporan</a> /
        <a class="redtext" href="{{ route('laporan.tahunKelulusan') }}"> Laporan Alumni berdasarkan Waktu Lulus </a> / Detail Alumni berdasarkan Waktu Lulus</p>

    <h3 class="mt-3">List Alumni</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Alumni</th>
                <th>Program Studi</th>
                <th>Tahun untuk Lulus</th>
                <th>Tanggal Yudisium</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tahunLulus->sortByDesc('tgl_yudisium') as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->NIM }}</td>
                <td>{{ $item->nama_mhs }}</td>
                <td>{{ $item->nama_prodi }}</td>
                @if ($item->bulankelulusan >= 6 && $item->bulankelulusan <= 9)
                <td>{{ $item->tahunKelulusan }} Tahun</td>
                @else
                <td>{{ $item->tahunKelulusan - 0.5 }} Tahun</td>
                @endif
                <td>{{ $item->tgl_yudisium }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
