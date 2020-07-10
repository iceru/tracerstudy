@extends('layout.adminapp')

@section('title')
Sektor Perusahaan
@endsection

@section('content')
<div class="wrap-input">

    <div class="input-title">
        <h2>Input Data Sektor Perusahaan</h2>
        <hr>
    </div>
    @can('data-create')
    <div class="button-create">
        <a href="{{ route('sektor.create') }}" class="button-red">Create Data Sektor Perusahaan</a>
    </div>
    @endcan

    <div class="output-data">
        <table class="table tablesorter" id="myTable">
            <thead>
                <tr>
                    <th>No <i class="fas fa-sort    "></i></th>
                    <th>Nama Sektor <i class="fas fa-sort    "></i></th>
                    @can('data-edit')
                    <th>Action</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($sektor as $item)
                <tr>
                    <td scope="row">{{ ($sektor ->currentpage()-1) * $sektor ->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $item->nama_sektor }}</td>
                    @can('data-edit')
                    <td id="action">
                        <a href="{{ route('sektor.edit', $item->id) }}"><i class="fas fa-edit    "></i>  Edit</a>
                        <form action="{{ route('sektor.destroy', $item->id )}}" method="get">
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
        {{ $sektor->links() }}
    </div>
</div>
@endsection


