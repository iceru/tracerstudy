@extends('layout.adminapp')

@section('title')
Sektor Perusahaan
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="wrap-input">
    <div class="input-title">
        <h2>Input Data Sektor Perusahaan</h2>
        <hr>
    </div>
    <div class="back-to-data">
        <a href="{{ route('sektor.index' )}}"><i class="fas fa-arrow-left    "></i> Back to Data</a>
    </div>
    <div class="input-form pt-3">
        <form action="{{ route('sektor.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Sektor Perusahaan</label>
                <input type="text" class="form-control" name="nama_sektor" id="nama_sektor">
            </div>

            <button type="submit" class="button-red">Submit</button>
        </form>
    </div>
</div>
@endsection
