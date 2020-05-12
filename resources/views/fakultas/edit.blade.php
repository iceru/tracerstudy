@extends('layout.adminapp')

@section('title')
    Update Fakultas
@endsection

@section('content')
<div class="input-title">
    <h2>Update Data Fakultas</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('fakultas.update', $fakultas->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="id">ID Fakultas</label>
            <input type="text" class="form-control" name="id_fakultas" id="id_fakultas" value="{{ old('id_fakultas', $fakultas->id) }}" readonly>
        </div>

        <div class="form-group">
            <label for="">Nama Fakultas</label>
            <input type="text" class="form-control" name="nama_fakultas" id="nama_fakultas" value="{{ old('nama_fakultas', $fakultas->nama_fakultas) }}">
        </div>

        <button class="btn btn-warning" type="submit">Update</button>
        <button class="btn btn-secondary" href="{{ route('fakultas.create') }}">Cancel</button>
    </form>

</div>
@endsection
