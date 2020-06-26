@extends('layout.adminapp')

@section('title')
    Laporan Jarak QS Stars
@endsection

@section('content')
<div class="wrap-input">
    <h3 class="py-2">Jarak Perusahan Alumni dengan Universitas</h3>
    <div class="opsi d-flex" style="float: none">
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
    <div class="export py-3">
        <h5 class="pb-2">Export Data Using Excel</h5>
        <a href="{{ route('jarak.export') }}" class="button-red">Export Data to Excel</a>
    </div>

        <table class="table mt-4">
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
                @foreach ($data as $item)
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
</div>

@endsection
