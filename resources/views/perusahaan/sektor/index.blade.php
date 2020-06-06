@extends('layout.adminapp')

@section('title')
Sektor Perusahaan
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Sektor Perusahaan</h2>
    <hr>
</div>

<div class="button-create">
    <a href="{{ route('sektor.create') }}" class="button-red">Create Data Sektor Perusahaan</a>
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
                    <a href="{{ route('sektor.edit', $item->id) }}"><i class="fas fa-edit    "></i>  Edit</a>
                    <form action="{{ route('sektor.destroy', $item->id )}}" method="get">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
