@extends('layout.adminapp')

@section('content')
<a href="{{ route('laporan.indexChartBidang') }}"><i class="fas fa-arrow-left    "></i> &nbsp; Kembali ke Laporan Kesesuaian Bidang</a>
<h3 class="mt-3">List Alumni</h3>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Alumni</th>
            <th>Kontak</th>
            <th>Email</th>
            <th>Kesesuaian Bidang</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bidang as $item)
        <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td>{{ $item->nama_mhs }}</td>
            <td>{{ $item->no_hp }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->nama_opsi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
