@extends('layout.adminapp')

@section('title')
    Update Opsi Pertanyaan
@endsection

@section('content')
<div class="input-title">
    <h2>Update Data Opsi Pertanyaan (Multiple Answers)</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('opsi.updateMultiple', $opsi->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="id">ID Opsi Pertanyaan</label>
            <input type="text" class="form-control" name="id_opsi" id="id_opsi" value="{{ old('id_opsi', $opsi->id) }}" readonly>
        </div>

        <div class="form-group">
            <label for="">Nama Opsi Pertanyaan</label>
            <input type="text" class="form-control" name="nama_opsi" id="nama_opsi" value="{{ old('nama_opsi', $opsi->nama_opsi_ma) }}" >
        </div>

        <div class="form-group">
            <label for="id_pertanyaan">Pertanyaan</label>
            <select class="form-control" name="id_pertanyaan" id="id_pertanyaan">
                @foreach ($pertanyaan as $pertanyaan)
                <option value="{{ $pertanyaan->id }}" {!! old('nama_pertanyaan', $opsi->pertanyaanMa->id) == $pertanyaan->id ? 'selected="selected"' : '' !!}> {{ $pertanyaan->nama_pertanyaan_ma }}</option>
                @endforeach
            </select>
          </div>

        <button class="btn btn-warning" type="submit">Update</button>
        <button class="btn btn-secondary" href="{{ route('opsi.createMultiple') }}">Cancel</button>
    </form>

</div>
@endsection
