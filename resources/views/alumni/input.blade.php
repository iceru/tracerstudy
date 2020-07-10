@extends('layout.adminapp')

@section('title')
Opsi
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Alumni</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('alumni.storeadmin') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama">Nomor Induk Mahasiswa</label>
            <select class="form-control" name="NIM" id="NIM">
                @foreach ($mahasiswa as $item)
                    <option value="{{ $item->NIM }}">{{ $item->NIM }} - {{ $item->nama_mhs }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" >
        </div>

        <div class="form-group">
            <label for="">Nomor Handphone</label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" aria-describedby="helpId" >
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    {{-- <hr>
    <h3>Import / Export Data Using Excel</h1>
    <form action="{{ route('alumni.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Import Excel Data</label>
          <input type="file" class="form-control-file" name="file" aria-describedby="fileHelpId">
          <small id="fileHelpId" class="form-text text-muted">Upload File xls/xlsx</small>
        </div>

        <div class="form-group">
        <button type="submit" class="btn btn-primary">Import Data Alumni</button>
        <a href="{{ route('alumni.export') }}" class="btn btn-warning">Export Data Alumni</a>
        </div>

    </form> --}}

</div>

@endsection
