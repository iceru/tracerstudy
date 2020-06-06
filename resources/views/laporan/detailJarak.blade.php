@extends('layout.adminapp')

@section('content')
@foreach ($jarak as $jarak)
<p>Nama Alumni: {{ $jarak->nama_mhs }}</p>
<p>Perusahaan: {{ $jarak->nama_perusahaan }}</p>
<p>Alamat Perusahaan: {{ $jarak->alamat_perusahaan }}</p>
@endforeach

@endsection
