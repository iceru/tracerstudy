@extends('layout.adminapp')

@section('title')
    Fakultas
@endsection

@section('content')
<div class="wrap-input">

    <div class="input-title">
        <h2>Data Fakultas</h2>
        <hr>
    </div>

    <div class="button-create">
        <a href="{{ route('fakultas.create') }}" class="button-red">Create Data Fakultas</a>
    </div>

    <div class="output-data">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Fakultas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fakultas as $item)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_fakultas }}</td>
                    <td id="action">
                        <a href="{{ route('fakultas.edit', $item->id) }}"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('fakultas.destroy', $item->id )}}" method="get">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
