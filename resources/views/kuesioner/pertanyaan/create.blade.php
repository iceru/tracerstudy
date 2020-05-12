@extends('layout.adminapp')

@section('title')
Pertanyaan
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Pertanyaan</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('pertanyaan.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Pertanyaan</label>
            <input type="text" class="form-control" name="nama_pertanyaan" id="nama_pertanyaan">
        </div>

        <div class="form-group">
            <label for="jenis_pertanyaan">Jenis Pertanyaan</label>
             <select class="form-control" name="jenis_pertanyaan" id="jenis_pertanyaan">
               <option value="multiple-choice">Multiple Choice</option>
               <option value="multiple-answer">Multiple Answer</option>
               <option value="direct-answer">Direct Answer</option>
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
                <td>{{ $item->nama_pertanyaan }}</td>
                <td id="action">
                    <a href="{{ route('pertanyaan.edit', $item->id) }}">Edit </a>
                    <form action="{{ route('pertanyaan.destroy', $item->id )}}" method="get">
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
