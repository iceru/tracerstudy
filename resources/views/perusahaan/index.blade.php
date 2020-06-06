@extends('layout.adminapp')

@section('title')
Perusahaan
@endsection

@section('content')
<div class="input-title">
    <h2>Input Data Perusahaan</h2>
    <hr>
</div>

<div class="button-create">
    <a href="{{ route('perusahaan.create') }}" class="button-red">Create Data Perusahaan</a>
</div>

<div class="output-data">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Perusahaan</th>
                <th>Nama Perusahaan</th>
                <th>Alamat Perusahaan</th>
                <th>Kontak Perusahaan</th>
                <th>Sektor Perusahaan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perusahaan as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_perusahaan }}</td>
                <td>{{ $item->alamat_perusahaan }}</td>
                <td>{{ $item->kontak_perusahaan }}</td>
                <td>{{ $item->sektor->nama_sektor }}</td>
                <td id="action">
                    <a href="{{ route('perusahaan.edit', $item->id) }}"><i class="fas fa-edit    "></i> Edit</a>
                    <form action="{{ route('perusahaan.destroy', $item->id )}}" method="get">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div
@endsection

@section('js')
    @parent
    <script src="/js/mapInput.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo9D3Po2G2-v6glNuomZixg_TOnkaBT4U&libraries=places&callback=initialize" async defer></script>
@stop
