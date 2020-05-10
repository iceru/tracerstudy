@extends('layout.adminapp')

@section('title')
Program Studi
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Program Studi</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('prodi.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="nama">Nama Program Studi</label>
            <input type="text" class="form-control" name="nama_prodi" id="nama_prodi" aria-describedby="helpId"
                placeholder="Nama Program Studi">
        </div>

        <div class="form-group">
          <label for="">Fakultas</label>
          <select class="form-control" name="id_fakultas" id="id_fakultas">
              @foreach ($fakultas as $fakultas)
              <option value="{{ $fakultas->id }}">{{ $fakultas->nama_fakultas }}</option>
              @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<div class="output-data">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Prodi</th>
                <th>Nama Prodi</th>
                <th>Fakultas</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prodi as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_prodi }}</td>
                <td>{{ $item->fakultas->nama_fakultas }}</td>
                <td id="action">
                    <a href="{{ route('prodi.edit', $item->id) }}">Edit </a>
                    <form action="{{ route('prodi.destroy', $item->id )}}" method="get">
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
