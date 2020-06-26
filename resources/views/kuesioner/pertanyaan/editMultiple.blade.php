@extends('layout.adminapp')

@section('title')
    Update Pertanyaan
@endsection

@section('content')
<div class="input-title">
    <h2>Update Data Pertanyaan</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('pertanyaan.updateMultiple', $pertanyaan->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="id">ID Pertanyaan</label>
            <input type="text" class="form-control" name="id" id="id" value="{{ old('id', $pertanyaan->id) }}" readonly>
        </div>

        <div class="form-group">
            <label for="">Nama Pertanyaan</label>
            <input type="text" class="form-control" name="nama_pertanyaan" id="nama_pertanyaan" value="{{ old('nama_pertanyaan', $pertanyaan->nama_pertanyaan_ma) }}">
        </div>

        <button class="btn btn-warning" type="submit">Update</button>
        <button class="btn btn-secondary" href="{{ route('pertanyaan.create') }}">Cancel</button>
    </form>

</div>
@endsection
