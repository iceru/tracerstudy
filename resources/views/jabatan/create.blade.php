@extends('layout.adminapp')

@section('title')
Jabatan
@endsection

@section('content')
<div class="wrap-input">
    <div class="input-title">
        <h2>Input Data Jabatan</h2>
        <hr>
    </div>
    <div class="back-to-data py-3">
        <a href="{{ route('jabatan.index' )}}"><i class="fas fa-arrow-left    "></i> Back to Data</a>
    </div>

    <div class="input-form">
        <form action="{{ route('jabatan.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Jabatan</label>
                <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


@endsection
