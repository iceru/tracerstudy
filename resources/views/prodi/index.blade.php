@extends('layout.adminapp')

@section('title')
Program Studi
@endsection

@section('content')
<div class="wrap-input">

    <div class="input-title">
        <h2>Input Data Program Studi</h2>
        <hr>
    </div>

    <div class="button-create">
        <a href="{{ route('prodi.create') }}" class="button-red">Create Data Program Studi</a>
    </div>

    <div class="output-data">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Prodi</th>
                    <th>Fakultas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prodi as $item)
                <tr>
                    <td scope="row">{{ ($prodi ->currentpage()-1) * $prodi ->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $item->nama_prodi }}</td>
                    <td>{{ $item->fakultas->nama_fakultas }}</td>
                    <td id="action">
                        <a href="{{ route('prodi.edit', $item->id) }}"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('prodi.destroy', $item->id )}}" method="get">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $prodi->links() }}
    </div>
</div>
@endsection
