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
        <h2>Update Data Pekerjaan Alumni</h2>
        <hr>
    </div>

    <div class="back-to-data py-3">
        <a href="{{ route('pekerjaan.index' )}}"><i class="fas fa-arrow-left"></i> Back to Data</a>
    </div>

    <div class="input-form">
        <form action="{{ route('pekerjaan.update', $pekerjaan->id)}}" method="post">
            @csrf
            @method('PATCH')
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
            <button class="btn btn-secondary" href="{{ route('pekerjaan.index') }}">Cancel</button>
        </form>

    </div>
</div>
@endsection
