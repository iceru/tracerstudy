@extends('layout.adminapp')

@section('title')
Program Studi
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Program Studi</h2>
    <hr>
</div>

<div class="back-to-data py-3">
    <a href="{{ route('prodi.index' )}}"><i class="fas fa-arrow-left    "></i> Back to Data</a>
</div>

<div class="input-form">
    <form action="{{ route('prodi.store') }}" method="post">
        @csrf

        <div class="form-group row pt-3">
            <label for="nama" class="col-md-2">Nama Program Studi</label>
            <input type="text" class="form-control col-md-6" name="nama_prodi" id="nama_prodi" aria-describedby="helpId"
                placeholder="Nama Program Studi">
        </div>

        <div class="form-group row">
          <label for="id_fakultas" class="col-md-2">Fakultas</label>
          <select class="form-control col-md-6" name="id_fakultas" id="id_fakultas">
              @foreach ($fakultas as $fakultas)
              <option value="{{ $fakultas->id }}">{{ $fakultas->nama_fakultas }}</option>
              @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
