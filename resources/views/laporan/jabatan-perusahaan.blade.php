@extends('layout.adminapp')

@section('content')
<div class="wrap-input">

    <h2>Data Jabatan dan Perusahaan Alumni</h2>
    <hr>
    <div class="export">
        <h5 class="pb-2">Export Data Using Excel</h5>
        <a href="{{ route('pekerjaan.export') }}" class="button-red">Export Data to Excel</a>
    </div>
    <div class="graph">
        <a href="{{ route('laporan.indexChartJabatan') }}">
            <div class="graphleft row">
                <div class="col-md-2">
                    <i class="fas fa-user-tie fa-3x"></i>
                </div>
                <div class="col-md-10 d-flex align-items-center">
                    <h4>Grafik Alumni berdasarkan Jabatan</h4>
                </div>
            </div>
        </a>
        <a href="{{ route('laporan.indexChartPerusahaan') }}">
            <div class="graphright row">
                <div class="col-md-2">
                    <i class="fa fa-building fa-3x"></i>
                </div>
                <div class="col-md-10 d-flex align-items-center">
                    <h4>Grafik Alumni berdasarkan Perusahaan</h4>
                </div>
            </div>
        </a>
    </div>



    <div class="opsi d-flex">
        <div class="fakultas pr-4">
            <div onclick="ddFakultas()" class="wrdd" tabindex="1">
              <span>{{ $fakultasNama }}</span>
              <ul class="dd-item" id="ddfakultas">
                @foreach ($fakultas as $item)
                <li><a href="{{request()->fullUrlWithQuery(['fakultas'=> $item->nama_fakultas])}}">{{ $item->nama_fakultas }} </a></li>
                @endforeach
              </ul>
            </div>
        </div>

        <div class="prodi pr-4">
            <div onclick="ddProdi()" class="wrdd" tabindex="1">
              <span>{{ $prdName }}</span>
              <ul class="dd-item" id="ddprodi">
                @foreach ($prodi as $item)
                <li><a href="{{request()->fullUrlWithQuery(['prodi'=> $item->nama_prodi])}}">{{ $item->nama_prodi }} </a></li>
                @endforeach
              </ul>
            </div>
        </div>

        <div class="lulusan pr-4">
            <div onclick="ddLulusan()" class="wrdd" tabindex="1">
              <span>{{ $llsName }}</span>
              <ul class="dd-item" id="ddlulusan">
                @foreach ($lulusan as $item)
                <li><a href="{{request()->fullUrlWithQuery(['lulusan'=> $item->lulusan])}}">{{ $item->lulusan }} </a></li>
                @endforeach
              </ul>
            </div>
        </div>

        <a style="margin: 20px 0" href="{{request()->url()}}" class="button-red">Clear Filter</a>

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
                <th>Program Studi</th>
                <th>Fakultas</th>
                <th>Tahun Kelulusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_mhs }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->nama_jabatan }}</td>
                <td>{{ $item->nama_perusahaan }}</td>
                <td>{{ $item->nama_prodi }}</td>
                <td>{{ $item->nama_fakultas }}</td>
                <td>{{ $item->lulus }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
