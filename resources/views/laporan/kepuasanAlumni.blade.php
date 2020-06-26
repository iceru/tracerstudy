@extends('layout.adminapp')

@section('content')

<div class="opsi d-flex">
    <div class="fakultas pr-4">
        <div onclick="ddFakultas()" class="wrdd" tabindex="1">
          <span>{{ $fklName }}</span>
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

    <div class="lulusan">
        <div onclick="ddLulusan()" class="wrdd" tabindex="1">
          <span>Tahun Kelulusan</span>
          <ul class="dd-item" id="ddlulusan">
            @foreach ($lulusan as $item)
            <li><a href="{{request()->fullUrlWithQuery(['lulusan'=> $item->lulusan])}}">{{ $item->lulusan }} </a></li>
            @endforeach
          </ul>
        </div>
    </div>

</div>

<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Rata-rata Kepuasaan Alumni</th>
            <th>Total Alumni</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bidang as $item)
        <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td>{{ $item->nama_opsi  }}</td>
            <td>{{ $item->countBidang }}</td>
            <td><a href="{{ route('laporan.showBidang', $item->id) }}">Detail Alumni</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
