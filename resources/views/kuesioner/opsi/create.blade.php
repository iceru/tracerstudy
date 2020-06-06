@extends('layout.adminapp')

@section('title')
Opsi
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Opsi</h2>
    <hr>
</div>
<div class="input-form">
    <form action="{{ route('opsi.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Opsi</label>
            <input type="text" class="form-control" name="nama_opsi" id="nama_opsi" aria-describedby="helpId" placeholder="Nama Opsi">
        </div>

        <div class="form-group">
            <label for="">Pertanyaan</label>
            <select class="form-control" name="id_pertanyaan" id="id_pertanyaan">
                @foreach ($pertanyaan as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_pertanyaan }}</option>
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
                <th>ID Opsi</th>
                <th>Nama Opsi</th>
                <th>Pertanyaan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opsis as $opsi)
            <tr>
                <td scope="row">{{ ($opsis ->currentpage()-1) * $opsis ->perpage() + $loop->index + 1 }}</td>
                <td>{{ $opsi->id }}</td>
                <td>{{ $opsi->nama_opsi }}</td>
                <td>{{ $opsi->pertanyaan->nama_pertanyaan }}</td>
                <td id="action">
                    <a href="{{ route('opsi.edit', $opsi->id) }}"><i class="fas fa-edit    "></i>  Edit </a>
                    <form action="{{ route('opsi.destroy', $opsi->id )}}" method="get">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{ $opsis->links() }}

</div>
@endsection
