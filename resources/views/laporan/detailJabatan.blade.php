@extends('layout.adminapp')

@section('content')
<h3>List Alumni pada Jabatan {{ $jabatanNama->nama_jabatan }}</h3>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Alumni</th>
            <th>Kontak</th>
            <th>Email</th>
            <th>Perusahaan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jabatan as $item)
        <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td>{{ $item->nama_mhs }}</td>
            <td>{{ $item->no_hp }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->nama_perusahaan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
