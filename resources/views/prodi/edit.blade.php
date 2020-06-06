@extends('layout.adminapp')

@section('title')
    Update Program Studi
@endsection

@section('content')
<div class="input-title">
    <h2>Update Data Program Studi</h2>
    <hr>
</div>

<div class="back-to-data py-3">
    <a href="{{ route('prodi.index' )}}"><i class="fas fa-arrow-left    "></i> Back to Data</a>
</div>

<div class="input-form">
    <form action="{{ route('prodi.update', $prodi->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="id">ID Program Studi</label>
            <input type="text" class="form-control" name="id" id="id" value="{{ old('id', $prodi->id) }}" readonly>
        </div>

        <div class="form-group">
            <label for="">Nama Fakultas</label>
            <input type="text" class="form-control" name="nama_prodi" id="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" >
        </div>

        <div class="form-group">
            <label for="">Fakultas</label>
            <select class="form-control" name="id_fakultas" id="id_fakultas">
                @foreach ($fakultas as $fakultas)
                <option value="{{ $fakultas->id }}" {!! old('nama_fakultas', $prodi->fakultas->id) == $fakultas->id ? 'selected="selected"' : '' !!}> {{ $fakultas->nama_fakultas }}</option>
                @endforeach
            </select>
          </div>

        <button class="btn btn-warning" type="submit">Update</button>
        <button class="btn btn-secondary" href="{{ route('prodi.create') }}">Cancel</button>
    </form>

</div>
@endsection
