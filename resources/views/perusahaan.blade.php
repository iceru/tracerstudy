@extends('layout.adminapp')

@section('title')
Perusahaan
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Perusahaan</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('perusahaan.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Perusahaan</label>
            <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan">
        </div>

        <div class="form-group">
            <label for="alamat">Alamat Perusahaan</label>
            <input type="text" class="form-control" name="alamat_perusahaan" id="alamat_perusahaan">
        </div>

        <div class="form-group">
            <label for="nama">Kontak Perusahaan</label>
            <input type="text" class="form-control" name="kontak_perusahaan" id="kontak_perusahaan">
        </div>

        <div class="form-group">
            <label for="">Sektor Perusahaan</label>
            <select class="form-control" name="id_sektor" id="id_sektor">
                @foreach ($sektor as $sektor)
                <option value="{{ $sektor->id }}">{{ $sektor->nama_sektor }}</option>
                @endforeach
            </select>
          </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<div class="output-data">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Perusahaan</th>
                <th>Nama Perusahaan</th>
                <th>Alamat Perusahaan</th>
                <th>Kontak Perusahaan</th>
                <th>Sektor Perusahaan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perusahaan as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_perusahaan }}</td>
                <td>{{ $item->alamat_perusahaan }}</td>
                <td>{{ $item->kontak_perusahaan }}</td>
                <td>{{ $item->sektor->nama_sektor }}</td>
                <td id="action">
                    <a href="{{ route('perusahaan.edit', $item->id) }}">Edit </a>
                    <form action="{{ route('perusahaan.destroy', $item->id )}}" method="get">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div
@endsection
