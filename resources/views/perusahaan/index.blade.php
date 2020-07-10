@extends('layout.adminapp')

@section('title')
Perusahaan
@endsection

@section('content')
<div class="wrap-input">
    <div class="input-title">
        <h2>Data Perusahaan</h2>
        <hr>
    </div>
    @can ('data-create')
    <div class="button-create">
        <a href="{{ route('perusahaan.create') }}" class="button-red">Create Data Perusahaan</a>
    </div>
    @endcan

    <div class="output-data">
        <table class="table tablesorter" id="myTable">
            <thead>
                <tr>
                    <th>No <i class="fas fa-sort    "></i></th>
                    <th>Nama Perusahaan <i class="fas fa-sort    "></i></th>
                    <th>Alamat Perusahaan <i class="fas fa-sort    "></i></th>
                    <th>Regional <i class="fas fa-sort    "></i></th>
                    <th>No. Telp Perusahaan <i class="fas fa-sort    "></i></th>
                    <th>Email Perusahaan <i class="fas fa-sort    "></i></th>
                    <th>Sektor Perusahaan <i class="fas fa-sort    "></i></th>
                    @can ('data-edit')
                    <th>Action</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($perusahaan as $item)
                <tr>
                    <td scope="row">{{ ($perusahaan ->currentpage()-1) * $perusahaan ->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $item->nama_perusahaan }}</td>
                    <td>{{ $item->alamat_perusahaan }}</td>
                    <td>{{ $item->regional }}</td>
                    <td>{{ $item->nomor_perusahaan }}</td>
                    <td>{{ $item->email_perusahaan }}</td>
                    <td>{{ $item->sektor->nama_sektor }}</td>
                    @can ('data-edit')
                    <td id="action">
                        <a href="{{ route('perusahaan.edit', $item->id) }}"><i class="fas fa-edit    "></i> Edit</a>
                        <form action="{{ route('perusahaan.destroy', $item->id )}}" method="get">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $perusahaan->links() }}
    </div
</div>

@endsection

@section('js')
    @parent
    <script src="/js/mapInput.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo9D3Po2G2-v6glNuomZixg_TOnkaBT4U&libraries=places&callback=initialize" async defer></script>
@stop
