@extends('layout.adminapp')

@section('title')
Mahasiswa
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Mahasiswa</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('mahasiswa.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="nim">Nomor Induk Mahasiswa</label>
            <input type="text" class="form-control" name="NIM" id="NIM" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label for="nama">Nama Mahasiswa</label>
            <input type="text" class="form-control" name="nama_mhs" id="nama_mhs" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label for="tgl_yudisium">Tanggal Yudisium</label>
            <input type="text" class="form-control" name="tgl_yudisium" id="datepicker" aria-describedby="helpId"
                >
        </div>

        <div class="form-group">
            <label for="ipk">IPK</label>
            <input type="text" class="form-control" name="ipk" id="ipk" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label for="">Program Studi</label>
            <select class="form-control" name="id_prodi" id="id_prodi">
                @foreach ($prodi as $item)
                <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
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
