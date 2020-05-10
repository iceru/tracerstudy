@extends('layout.adminapp')

@section('title')
    Update Jabatan
@endsection

@section('content')
<div class="input-title">
    <h2>Update Data Jabatan</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('jabatan.update', $jabatan->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="id">ID Jabatan</label>
            <input type="text" class="form-control" name="id_jabatan" id="id_jabatan" value="{{ old('id_jabatan', $jabatan->id) }}" readonly>
        </div>

        <div class="form-group">
            <label for="">Nama Jabatan</label>
            <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}">
        </div>

        <button class="btn btn-warning" type="submit">Update</button>
        <button class="btn btn-secondary" href="{{ route('jabatan.index') }}">Cancel</button>
    </form>

</div>
@endsection
