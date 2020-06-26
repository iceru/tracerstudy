@extends('layout.adminapp')

@section('content')

<div class="wrap-input">
    <p><a class="redtext" href="{{ route('home') }}">Dahsboard</a> / <a class="redtext" href="{{ route('laporan.index') }}">Daftar Laporan</a> / Laporan Alumni berdasarkan Waktu Lulus</p>
    <h3 class="my-4">Data Alumni berdasarkan Waktu untuk Lulus</h3>

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Waktu Alumni untuk Lulus</th>
                <th>Total Alumni</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tahunLulus as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->tahunKelulusan  }} Tahun</td>
                <td>{{ $item->hitungKelulusan  }}</td>
                <td><a href="{{ route('laporan.detailKelulusan', $item->tahunKelulusan) }}">Detail</a> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
