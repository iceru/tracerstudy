@extends('layout.adminapp')

@section('title')
    Update Perusahaan
@endsection

@section('content')
<div class="input-title">
    <h2>Update Data Perusahaan</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('perusahaan.update', $perusahaan->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="id">ID Perusahaan</label>
            <input type="text" class="form-control" name="id_perusahaan" id="id_perusahaan" value="{{ old('id_perusahaan', $perusahaan->id) }}" readonly>
        </div>

        <div class="form-group">
            <label for="">Nama Perusahaan</label>
            <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}" >
        </div>

        <div class="form-group">
            <label for="">Alamat Perusahaan</label>
            <input type="text" class="form-control" name="alamat_perusahaan" id="alamat_perusahaan" value="{{ old('alamat_perusahaan', $perusahaan->alamat_perusahaan) }}" >
        </div>

        <div class="form-group">
            <label for="">Kontak Perusahaan</label>
            <input type="text" class="form-control" name="kontak_perusahaan" id="kontak_perusahaan" value="{{ old('kontak_perusahaan', $perusahaan->kontak_perusahaan) }}" >
        </div>

        <div class="form-group">
            <label for="">Sektor Perusahaan</label>
            <select class="form-control" name="id_sektor" id="id_sektor">
                @foreach ($sektor as $sektor)
                <option value="{{ $sektor->id }}"> {{ $sektor->nama_sektor }}</option>
                @endforeach
            </select>
          </div>

        <button class="btn btn-warning" type="submit">Update</button>
        <button class="btn btn-secondary" href="{{ route('perusahaan.create') }}">Cancel</button>
    </form>

</div>
@endsection
