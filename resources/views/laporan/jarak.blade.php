@extends('layout.adminapp')

@section('content')
<h3 class="py-2">Jarak Perusahan Alumni dengan Universitas</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alumni</th>
                <th>NIM</th>
                <th>Perusahaan Alumni</th>
                <th>Jarak</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumni as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_mhs }}</td>
                <td>{{ $item->NIM }}</td>
                <td>{{ $item->alamat_perusahaan }}</td>
                <td>{{ round($item->distance, 2) }} KM</td>
                <td><a href="{{ route('laporan.showJarak', $item->id) }}">Detail</a></td>
            </tr>
            @endforeach

        </tbody>
    </table>
@endsection
