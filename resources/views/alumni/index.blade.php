@extends('layout.adminapp')

@section('title')
Opsi
@endsection

@section('content')
<div class="input-title">
    <h2>Data Alumni</h2>
    <hr>
</div>

<div class="button-create">
    <a href="{{ route('alumni.input') }}" class="button-red">Create Data Alumni</a>
</div>

<div class="output-data">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Alumni</th>
                <th>Nama Alumni</th>
                <th>NIM</th>
                <th>Nomor Handphone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnis as $alumni)
            <tr>
                <td scope="row">{{ ($alumnis ->currentpage()-1) * $alumnis ->perpage() + $loop->index + 1 }}</td>
                <td>{{ $alumni->id }}</td>
                <td>{{ $alumni->mahasiswa->nama_mhs }}</td>
                <td>{{ $alumni->NIM }}</td>
                <td>{{ $alumni->no_hp}}</td>
                <td>{{ $alumni->email}}</td>
                <td id="action">
                    <a href="{{ route('alumni.edit', $alumni->id) }}"><i class="fas fa-edit    "></i>  Edit </a>
                    <form action="{{ route('alumni.destroy', $alumni->id )}}" method="get">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{ $alumnis->links() }}

</div>
@endsection
