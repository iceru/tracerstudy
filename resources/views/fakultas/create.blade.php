@extends('layout.adminapp')

@section('title')
    Fakultas
@endsection

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        Input Error <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif
<div class="wrap-input">
    <div class="input-title">
        <h2>Input Data Fakultas</h2>
        <hr>
    </div>

    <div class="back-to-data py-3">
        <a href="{{ route('fakultas.index' )}}"><i class="fas fa-arrow-left    "></i> Back to Data</a>
    </div>

    <div class="input-form">
        <form action="{{ route('fakultas.store') }}" method="post">
            @csrf
            <div class="form-group row py-3">
                <label for="" class="col-md-2">Nama Fakultas</label>
                <input type="text" class="form-control col-md-6" name="nama_fakultas" id="nama_fakultas" aria-describedby="helpId" placeholder="Nama Fakultas">
            </div>

            <button class="button-red" type="submit">Submit</button>
        </form>
    </div>
</div>
@endsection
