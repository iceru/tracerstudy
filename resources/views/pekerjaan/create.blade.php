@extends('layout.adminapp')

@section('title')
Pekerjaan Alumni
@endsection

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        Upload Validation Error <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
<div class="wrap-input">

    <div class="input-title">
        <h2>Input Data Pekerjaan Alumni</h2>
        <hr>
    </div>

    <div class="back-to-data py-3">
        <a href="{{ route('pekerjaan.index' )}}"><i class="fas fa-arrow-left"></i> Back to Data</a>
    </div>

    <div class="input-form">
        <form action="{{ route('pekerjaan.store')}}" method="post">
            @csrf

            <div class="form-group row">
                <label for="" class="col-md-2">Alumni</label>
                <select class="form-control col-md-6" name="id_alumni">
                    @foreach ($alumni as $item)
                    <option value="{{ $item->id }}">{{ $item->mahasiswa->nama_mhs }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group row">
                <label for="" class="col-md-2">Jabatan</label>
                <select class="form-control col-md-6" name="id_jabatan">
                    @foreach ($jabatan as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group row">
                <label for="" class="col-md-2">Perusahaan</label>
                <select class="form-control col-md-6" name="id_perusahaan">
                    @foreach ($perusahaan as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_perusahaan }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="button-red">Submit</button>
        </form>

        {{-- <hr>
        <h3>Import / Export Data Using Excel</h1>
        <form action="{{ route('mahasiswa.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="">Import Excel Data</label>
              <input type="file" class="form-control-file" name="file" aria-describedby="fileHelpId">
              <small id="fileHelpId" class="form-text text-muted">Upload File xls/xlsx</small>
            </div>

            <div class="form-group">
            <button type="submit" class="btn btn-primary">Import Data Mahasiswa</button>
            <a href="{{ route('mahasiswa.export') }}" class="btn btn-warning">Export Data Mahasiswa</a>
            </div>

        </form> --}}

    </div>
</div>
@endsection
