@extends('layout.adminapp')

@section('title')
Mahasiswa
@endsection

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        Upload Validation Error <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alaert">x</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
<div class="input-title">
    <h2>Data Mahasiswa</h2>
    <hr>
</div>

<div class="button-create">
    <a href="{{ route('mahasiswa.create') }}" class="button-red">Create Data Mahasiswa</a>
</div>

    <div class="output-data">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Tanggal Yudisium</th>
                    <th>IPK</th>
                    <th>Program Studi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $item)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $item->NIM }}</td>
                    <td>{{ $item->nama_mhs }}</td>
                    <td>{{ $item->tgl_yudisium }}</td>
                    <td>{{ $item->ipk }}</td>
                    <td>{{ $item->prodi->nama_prodi }}</td>
                    <td id="action">
                        <a href="{{ route('mahasiswa.edit', $item->NIM) }}"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $item->NIM )}}" method="get">
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
@endsection

@section('js')
@endsection
