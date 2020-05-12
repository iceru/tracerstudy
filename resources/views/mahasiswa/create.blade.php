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
    <h2>Input Data Mahasiswa</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('mahasiswa.store')}}" method="post">
        @csrf
        <div class="form-group row">
            <label for="nim" class="col-md-2">Nomor Induk Mahasiswa</label>
            <input type="text" class="form-control col-md-6" name="NIM" id="NIM" aria-describedby="helpId">
        </div>

        <div class="form-group row">
            <label for="nama" class="col-md-2">Nama Mahasiswa</label>
            <input type="text" class="form-control col-md-6" name="nama_mhs" id="nama_mhs" aria-describedby="helpId">
        </div>

        <div class="form-group row">
            <label for="tgl_yudisium" class="col-md-2">Tanggal Yudisium</label>
            <input type="text" class="form-control col-md-6 " name="tgl_yudisium" id="datepicker" aria-describedby="helpId"
                >
        </div>

        <div class="form-group row">
            <label for="ipk" class="col-md-2">IPK</label>
            <input type="text" class="form-control col-md-6" name="ipk" id="ipk" aria-describedby="helpId">
        </div>

        <div class="form-group row">
            <label for="" class="col-md-2">Program Studi</label>
            <select class="form-control col-md-6" name="id_prodi" id="id_prodi">
                @foreach ($prodi as $item)
                <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <hr>
    <h3>Import / Export Data Using Excel</h1>
    <form action="{{ route('mahasiswa.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Import Excel Data</label>
          <input type="file" class="form-control-file" name="file" aria-describedby="fileHelpId">
          <small id="fileHelpId" class="form-text text-muted">Upload File xls/xlsx</small>
        </div>

        <div class="form-group">
        <button type="submit" class="btn btn-primary">Import Data Mahasiswa</button>
        <a href="{{ route('mahasiswa.export') }}" class="btn btn-warning">Export Data Mahasiswa</a>
        </div>

    </form>

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
                        <a href="{{ route('mahasiswa.edit', $item->NIM) }}">Edit </a>
                        <form action="{{ route('mahasiswa.destroy', $item->NIM )}}" method="get">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div
</div>
@endsection

@section('js')
@endsection
