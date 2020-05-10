@extends('layout.adminapp')

@section('title')
Sektor Perusahaan
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Sektor Perusahaan</h2>
    <hr>
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
<div class="output-data">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Sektor</th>
                <th>Nama Sektor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sektor as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_sektor }}</td>
                <td id="action">
                    <a href="{{ route('sektor.edit', $item->id) }}">Edit </a>
                    <form action="{{ route('sektor.destroy', $item->id )}}" method="get">
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
