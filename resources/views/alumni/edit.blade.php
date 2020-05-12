@extends('layout.adminapp')

@section('title')
    Update Alumni
@endsection

@section('content')
<div class="input-title">
    <h2>Update Data Alumni</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('alumni.update', $alumni->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="id">ID Alumni</label>
            <input type="text" class="form-control" name="id_alumni" id="id_alumni" value="{{ old('id_opsi', $alumni->id) }}" readonly>
        </div>

        <div class="form-group">
            <label for="">Nomor Induk Mahasiswa</label>
            <input type="text" class="form-control" name="NIM" id="NIM" value="{{ old('NIM', $alumni->NIM) }} - {{ $alumni->mahasiswa->nama_mhs }}" readonly>
        </div>

        <div class="form-group">
            <label for="">Nomor Handphone</label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp', $alumni->no_hp) }}">
        </div>

        <div class="form-group">
            <label for="">Nomor Induk Mahasiswa</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $alumni->email) }}">
        </div>


        <button class="btn btn-warning" type="submit">Update</button>
        <button class="btn btn-secondary" href="{{ route('alumni.index') }}">Cancel</button>
    </form>

</div>
@endsection
