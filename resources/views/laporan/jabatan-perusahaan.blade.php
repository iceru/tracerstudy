@extends('layout.adminapp')

@section('content')
    <h2>Data Jabatan dan Perusahaan Alumni</h2>
    <div class="graph">
        <div class="graphleft row">
            <div class="col-md-2">
                <i class="fas fa-user-tie fa-3x"></i>
            </div>
            <div class="col-md-10 d-flex align-items-center">
                <a href="{{ route('laporan.indexChartJabatan') }}"><h4>Grafik Alumni berdasarkan Jabatan</h4></a>
            </div>
        </div>
        <div class="graphright row">
            <div class="col-md-2">
                <i class="fa fa-building fa-3x"></i>
            </div>
            <div class="col-md-10 d-flex align-items-center">
                <a href="{{ route('laporan.indexChartPerusahaan') }}"><h4>Grafik Alumni berdasarkan Perusahaan</h4></a>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alumni</th>
                <th>No. HP</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Perusahaan</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jabatan as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_mhs }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->nama_jabatan }}</td>
                <td>{{ $item->nama_perusahaan }}</td>
                <td>Detail</td>
            </tr>
            @endforeach

        </tbody>
    </table>
@endsection
