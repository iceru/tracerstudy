@extends('layout.adminapp')

@section('title')
Jabatan
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Jabatan</h2>
    <hr>
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

<div class="output-data">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Jabatan</th>
                <th>Nama Jabatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jabatan as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_jabatan }}</td>
                <td id="action">
                    <a href="{{ route('jabatan.edit', $item->id) }}">Edit </a>
                    <form action="{{ route('jabatan.destroy', $item->id )}}" method="get">
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
