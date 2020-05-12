@extends('layout.adminapp')

@section('title')
Opsi
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Alumni</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('alumni.storeadmin') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama">Nomor Induk Mahasiswa</label>
            <select class="form-control" name="NIM" id="NIM">
                @foreach ($mahasiswa as $item)
                    <option value="{{ $item->NIM }}">{{ $item->NIM }} - {{ $item->nama_mhs }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" >
        </div>

        <div class="form-group">
            <label for="">Nomor Handphone</label>
            <input type="email" class="form-control" name="no_hp" id="no_hp" aria-describedby="helpId" >
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <hr>
    <h3>Import / Export Data Using Excel</h1>
    <form action="{{ route('alumni.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Import Excel Data</label>
          <input type="file" class="form-control-file" name="file" aria-describedby="fileHelpId">
          <small id="fileHelpId" class="form-text text-muted">Upload File xls/xlsx</small>
        </div>

        <div class="form-group">
        <button type="submit" class="btn btn-primary">Import Data Alumni</button>
        <a href="{{ route('alumni.export') }}" class="btn btn-warning">Export Data Alumni</a>
        </div>

    </form>

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
                    <a href="{{ route('alumni.edit', $alumni->id) }}">Edit </a>
                    <form action="{{ route('alumni.destroy', $alumni->id )}}" method="get">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{ $alumnis->links() }}

</div>
@endsection
