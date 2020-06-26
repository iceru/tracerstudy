@extends('layout.adminapp')

@section('content')
<h3>List Alumni pada Jabatan {{ $jabatanNama->nama_jabatan }}</h3>
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
            <th>Kontak</th>
            <th>Email</th>
            <th>Perusahaan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
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
