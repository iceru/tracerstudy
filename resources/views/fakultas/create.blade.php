@extends('layout.adminapp')

@section('title')
    Fakultas
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Fakultas</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('fakultas.store') }}" method="post">
        @csrf
        <div class="form-group row py-3">
            <label for="" class="col-md-2">Nama Fakultas</label>
            <input type="text" class="form-control col-md-6" name="nama_fakultas" id="nama_fakultas" aria-describedby="helpId" placeholder="Nama Fakultas">
        </div>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

</div>

<div class="output-data">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Fakultas</th>
                <th>Nama Fakultas</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fakultas as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_fakultas }}</td>
                <td id="action">
                    <a href="{{ route('fakultas.edit', $item->id) }}">Edit </a>
                    <form action="{{ route('fakultas.destroy', $item->id )}}" method="get">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
