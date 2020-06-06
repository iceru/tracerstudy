@extends('layout.adminapp')

@section('title')
    Update Sektor
@endsection

@section('content')
<div class="input-title">
    <h2>Update Data Sektor</h2>
    <hr>
</div>
<div class="back-to-data">
    <a href="{{ route('sektor.index' )}}"><i class="fas fa-arrow-left    "></i> Back to Data</a>
</div>
<div class="input-form">
    <form action="{{ route('sektor.update', $sektor->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="id">ID Sektor</label>
            <input type="text" class="form-control" name="id" id="id" value="{{ old('id', $sektor->id) }}" readonly>
        </div>

        <div class="form-group">
            <label for="">Nama Sektor</label>
            <input type="text" class="form-control" name="nama_sektor" id="nama_sektor" value="{{ old('nama_sektor', $sektor->nama_sektor) }}">
        </div>

        <button class="btn btn-warning" type="submit">Update</button>
        <button class="btn btn-secondary" href="{{ route('sektor.create') }}">Cancel</button>
    </form>

</div>
@endsection
