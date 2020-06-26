@extends('layout.adminapp')

@section('title')
Jabatan
@endsection

@section('content')
<div class="wrap-input">
    <div class="input-title">
        <h2>Data Jabatan</h2>
        <hr>
    </div>

    <div class="button-create">
        <a href="{{ route('jabatan.create') }}" class="button-red">Create Data Jabatan</a>
    </div>

    <div class="output-data">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jabatan as $item)
                <tr>
                    <td scope="row">{{ ($jabatan ->currentpage()-1) * $jabatan ->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $item->nama_jabatan }}</td>
                    <td id="action">
                        <a href="{{ route('jabatan.edit', $item->id) }}"><i class="fas fa-edit    "></i> Edit</a>
                        <form action="{{ route('jabatan.destroy', $item->id )}}" method="get">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $jabatan->links() }}
    </div>
</div>

@endsection
