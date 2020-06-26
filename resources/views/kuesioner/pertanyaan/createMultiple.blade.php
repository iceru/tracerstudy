@extends('layout.adminapp')

@section('title')
Pertanyaan
@endsection

@section('content')
<div class="input-title">
    <h2>Input Pertanyaan Multiple Answer</h2>
    <hr>
</div>

<div class="fakultas pr-4">
    <div onclick="ddFakultas()" class="wrdd2" tabindex="1">
      <span>Pilih Jenis Pertanyaan</span>
      <ul class="dd-item" id="ddfakultas">
        <li><a href="{{ route('pertanyaan.create') }}">Multiple Choice / Radio Button</a></li>
        <li><a href="{{ route('pertanyaan.createMultiple') }}">Multiple Answer / Checkbox</a></li>
        <li><a href="{{ route('pertanyaan.createDirect') }}">Direct Answer / Text</a></li>
      </ul>
    </div>
</div>

<div class="input-form">
    <form action="{{ route('pertanyaan.storeMultiple') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama">Pertanyaan</label>
            <input type="text" class="form-control" name="nama_pertanyaan" id="nama_pertanyaan">
        </div>

        <button type="submit" class="button-red">Submit</button>
    </form>
</div>

<div class="output-data">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pertanyaan</th>
                <th>Nama Pertanyaan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pertanyaan as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_pertanyaan_ma }}</td>
                <td id="action">
                    <a href="{{ route('pertanyaan.editMultiple', $item->id) }}"><i class="fas fa-edit    "></i> Edit </a>
                    <form action="{{ route('pertanyaan.destroyMultiple', $item->id )}}" method="get">
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
