@extends('layout.adminapp')

@section('title')
Sektor Perusahaan
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Sektor Perusahaan</h2>
    <hr>
</div>
<div class="back-to-data">
    <a href="{{ route('sektor.index' )}}"><i class="fas fa-arrow-left    "></i> Back to Data</a>
</div>
<div class="input-form">
    <form action="{{ route('sektor.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Sektor Perusahaan</label>
            <input type="text" class="form-control" name="nama_sektor" id="nama_sektor">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
