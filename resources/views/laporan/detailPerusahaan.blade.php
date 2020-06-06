@extends('layout.adminapp')

@section('content')
<h3>List Alumni pada Perusahaan {{ $perusahaanNama->nama_perusahaan }}</h3>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Alumni</th>
            <th>Kontak</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($perusahaan as $item)
        <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td>{{ $item->nama_mhs }}</td>
            <td>{{ $item->no_hp }}</td>
            <td>{{ $item->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
